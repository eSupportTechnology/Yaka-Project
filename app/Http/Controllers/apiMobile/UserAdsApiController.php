<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\FormField;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\AdDetail;
use App\Models\User;
use App\Services\OtpService;
use App\Services\PusherNotificationService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\ApiResponseService;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;


class UserAdsApiController extends Controller
{
    protected $apiResponse;
    protected $pusherService;

    public function __construct(ApiResponseService $apiResponse, PusherNotificationService $pusherService)
    {
        $this->apiResponse = $apiResponse;
        $this->pusherService = $pusherService;
    }

    public function store(Request $request)
    {
        try {
            // Get query parameters
            $cat_id = $request->query('cat_id');
            $sub_cat_id = $request->query('sub_cat_id');
            $location = $request->query('location');
            $sublocation = $request->query('sublocation');

            Log::info('API Store method called', [
                'request_data' => $request->all(),
                'query_params' => $request->query()
            ]);

            // Build dynamic validation rules
            $formFields = FormField::all();
            $dynamicRules = [];

            foreach ($formFields as $field) {
                $dynamicRules['field_' . $field->id] = 'nullable';
            }

            // Handle boosting option
            if ($request->boosting_option == '0') {
                $request->merge(['package_type' => '0']);
            }

            // Base validation rules with user_id required from frontend
            $validationRules = array_merge([
                'user_id' => 'required|integer|exists:users,id', // User ID from frontend
                'title' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'main_image' => 'required',
                'sub_images' => 'nullable|array',
                'sub_images.*' => 'required',
                'brand' => 'nullable',
                'model' => 'nullable',
                'condition' => 'nullable|in:New,Used',
                'pricing_type' => 'nullable|in:Fixed,Negotiable,Daily,Weekly,Monthly,Yearly',
                'post_type' => 'nullable|in:Booking,Sale,Rent',
                'boosting_option' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if ($value == '0') {
                            return;
                        }
                        if (!Package::find($value)) {
                            $fail('The selected boosting option is invalid.');
                        }
                    }
                ],
                'package_type' => [
                    'required_unless:boosting_option,0',
                    function ($attribute, $value, $fail) {
                        if (request('boosting_option') != '0' && !PackageType::where('id', $value)->exists()) {
                            $fail('The selected package type is invalid.');
                        }
                    }
                ],
                'experience_years' => 'nullable|integer|min:0',
                'education' => 'nullable|string|max:255',
                'application_deadline' => 'nullable|date',
                'mobile_number' => 'nullable|string|max:20',
            ], $dynamicRules);

            // Get user from frontend user_id
            $frontendUserId = $request->input('user_id');
            $user = User::find($frontendUserId);

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid user ID provided.',
                    'data' => null
                ], 400);
            }

            // Additional validation for staff users
            if ($user->roles === 'staff') {
                $validationRules = array_merge($validationRules, [
                    'user_first_name' => 'required|string|max:255',
                    'user_last_name' => 'required|string|max:255',
                    'user_phone_number' => 'required|string|max:10',
                ]);
            }

            // Validate request
            $validator = Validator::make($request->all(), $validationRules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();

            // Handle user creation for staff
            $userId = $validated['user_id']; // Get from frontend
            $createdByStaffId = null;
            $userPhoneNumber = $user->phone_number;

            if ($user->roles === 'staff') {
                $checkUser = User::where('phone_number', $validated['user_phone_number'])->first();
                if ($checkUser) {
                    $userId = $checkUser->id;
                } else {
                    // Create new user
                    $newUser = new User();
                    $newUser->first_name = $validated['user_first_name'];
                    $newUser->last_name = $validated['user_last_name'];
                    $newUser->email = $validated['user_email'] ?? 'N/A';
                    $newUser->phone_number = $this->makeMobileNumberFormat($validated['user_phone_number']);
                    $newUser->roles = 'user';
                    $newUser->created_by = 2;
                    $newUser->active_status = 1;
                    $newUser->password = Hash::make('12345678');
                    $newUser->save();

                    $userId = $newUser->id;
                }
                $createdByStaffId = $validated['user_id']; // Staff user ID from frontend
                $userPhoneNumber = $validated['user_phone_number'];

                Log::info('New user created by staff', [
                    'new_user_id' => $userId,
                    'staff_id' => $createdByStaffId
                ]);
            }

            // Calculate package expiry
            $packageExpireAt = null;

            if ($request->boosting_option != '0') {
                $packageType = PackageType::find($validated['package_type']);
                if ($packageType) {
                    $packageExpireAt = Carbon::now()->addDays((int)($packageType->duration));
                }
            } else {
                $packageExpireAt = Carbon::now()->addDays(30);
            }

            // Image processing
            $manager = new ImageManager(new Driver());
            $fixedWidth = 800;
            $fixedHeight = 800;

            $watermark = $manager->read(public_path('watermarks/yaka_watermark2.png'));

            // Process main image
            $image = $manager->read($request->file('main_image')->getPathname());
            $image->resize($fixedWidth, $fixedHeight);
            $image->place($watermark, 'center');

            $mainFile = $request->file('main_image');
            $extension = $mainFile->getClientOriginalExtension();
            $mainFilename = uniqid() . '.' . $extension;
            Storage::disk('public')->put('ads/main_images/' . $mainFilename, (string) $image->toJpeg());
            $mainImagePath = 'ads/main_images/' . $mainFilename;

            // Process sub images
            $subImagesPaths = [];

            if ($request->hasFile('sub_images')) {
                foreach ($request->file('sub_images') as $file) {
                    if ($file->isValid()) {
                        $image = $manager->read($file->getPathname());
                        $image->resize($fixedWidth, $fixedHeight);
                        $image->place($watermark, 'center');

                        $filename = uniqid() . '_' . $file->getClientOriginalName();
                        Storage::disk('public')->put('ads/sub_images/' . $filename, (string) $image->toJpeg());
                        $subImagesPaths[] = 'ads/sub_images/' . $filename;
                    }
                }
            }

            // Handle payment flow for boosted ads
            if ($request->boosting_option != '0') {
                $adData = $request->all();
                $adData['main_image'] = $mainImagePath;
                $adData['sub_images'] = $subImagesPaths;
                $adData['user_id'] = $userId;
                $adData['created_by_staff_id'] = $createdByStaffId;

                return response()->json([
                    'status' => 'success',
                    'message' => 'Ad data prepared for payment',
                    'data' => [
                        'requires_payment' => true,
                        'payment_data' => [
                            'package_id' => $request->boosting_option,
                            'package_type' => $request->package_type,
                            'selected_package_name' => $request->input('selected_package_name'),
                            'selected_package_price' => $request->input('selected_package_price'),
                            'selected_package_duration' => $request->input('selected_package_duration'),
                        ],
                        'ad_data' => $adData,
                    ]
                ], 200);
            }

            // Create ad for free posts
            $brand = $validated['brand'] ?? 'no brand';
            $model = $validated['model'] ?? 'no model';

            $ad = Ads::create([
                'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'user_id' => $userId,
                'created_by_staff_id' => $createdByStaffId,
                'title' => $validated['title'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'mainImage' => $mainImagePath,
                'subImage' => json_encode($subImagesPaths),
                'brand' => $brand,
                'model' => $model,
                'price_type' => $validated['pricing_type'] ?? null,
                'post_type' => $validated['post_type'] ?? null,
                'condition' => $validated['condition'] ?? null,
                'ads_package' => $request->boosting_option,
                'package_type' => $request->package_type,
                'package_expire_at' => $packageExpireAt,
                'cat_id' => $cat_id,
                'sub_cat_id' => $sub_cat_id,
                'location' => $location,
                'sublocation' => $sublocation,
                'status' => '0',
                'experience_years' => $request->input('experience_years'),
                'education' => $request->input('education'),
                'application_deadline' => $request->input('application_deadline'),
                'mobile_number' => $request->input('mobile_number'),
                'rotation_position' => -1,
                'last_rotated_at' => now(),
            ]);

            // Save dynamic form fields
            foreach ($formFields as $field) {
                $inputName = 'field_' . $field->id;
                $fieldValue = $request->input($inputName);

                if (!is_null($fieldValue) && $fieldValue !== '') {
                    AdDetail::create([
                        'adsId' => $ad->adsId,
                        'additional_info' => $field->field_name,
                        'value' => $fieldValue
                    ]);
                }
            }

            Log::info('Ad details saved successfully', [
                'ad_id' => $ad->adsId,
                'user_id' => $userId,
                'created_by_staff_id' => $createdByStaffId,
                'frontend_user_id' => $frontendUserId
            ]);

            // Send SMS notification (only if not staff posting for others)
            if ($user->roles != 'staff') {
                OtpService::sendSingleSms($userPhoneNumber, "Your ad has been successfully submitted! It will go live after admin approval. Thank you for using our platform.");
            }

            $this->pusherService->sendNewAdNotification($ad, $userId, $cat_id, $location);

            $successMessage = $user->roles === 'staff' ?
                'User created and ad posted successfully!' :
                'Ad posted successfully!';

            return response()->json([
                'status' => 'success',
                'message' => $successMessage,
                'data' => [
                    'ad_id' => $ad->adsId,
                    'ad' => $ad->load('details'),
                    'requires_payment' => false,
                    'user_id' => $userId,
                    'created_for_user_id' => $userId,
                    'created_by_user_id' => $frontendUserId
                ]
            ], 201);

        } catch (Exception $e) {
            Log::error('Error in API store method', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Format mobile number
     */
    private function makeMobileNumberFormat($phoneNumber)
    {
        return $phoneNumber;
    }

}
