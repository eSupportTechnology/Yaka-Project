<?php

namespace App\Http\Controllers\frontend;

use App\Models\BrandsModels;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Ads;
use App\Models\Package;
use App\Models\AdDetail;
use App\Models\Category;
use App\Models\Districts;
use App\Models\FormField;
use App\Models\PackageType;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserAdsController extends Controller
{

    public function ad_posts_categories(Request $request)
    {
        $categories = Category::where('status', 1)
            ->where('mainId', 0)
            ->with(['subcategories' => function ($query) {
                $query->where('status', 1);
            }])
            ->get();

        return view('newFrontend.user.ad_posts_categories', compact('categories'));
    }


    public function fetchSubcategories($categoryId)
    {
        $category = Category::with('subcategories')->find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $translatedSubcategories = $category->subcategories->map(function ($subcategory) {
            return [
                'id' => $subcategory->id,
                'name' => __('messages.' . $subcategory->name) // Translate subcategory name
            ];
        });

        return response()->json($translatedSubcategories);
    }



    public function ad_posts_location(Request $request)
    {
        $districts = Districts::with('cities')->get();
        return view('newFrontend.user.ad_posts_location', compact('districts'));
    }

    public function fetchCities($districtId)
    {
        // Fetch cities related to the district
        $district = Districts::with('cities')->find($districtId);
        if ($district) {
            return response()->json($district->cities);
        }
        return response()->json([]);
    }


    public function ad_posts(Request $request)
    {
        $categories = Category::where('status', 1)->where('mainId', 0)->get();

        $subcategories = collect();
        if ($request->cat_id) {
            $subcategories = Category::where('mainId', $request->cat_id)->get();
        }

        $brands = collect();
        if ($request->sub_cat_id) {
            $brands = BrandsModels::where('sub_cat_id', $request->sub_cat_id)
                ->where('brandsId', 0)
                ->get();
        }

        // Get models based on brandId and subCatId
        $models = collect();
        if ($request->brand && $request->sub_cat_id) {
            $models = BrandsModels::where('brandsId', $request->brand)
                ->where('sub_cat_id', $request->sub_cat_id)
                ->get();
        }

        $formFields = FormField::where('main_category_id', $request->cat_id)
            ->where('subcategory_id', $request->sub_cat_id)
            ->get();

        $packages = Package::with('packageTypes')
            ->where('name', '!=', 'Jump Up')
            ->where('id', '!=', 5)
            ->get();

        return view('newFrontend.user.ad_posts', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
            'models' => $models,
            'formFields' => $formFields,
            'packages' => $packages,
            'cat_id' => $request->query('cat_id', 0),
            'sub_cat_id' => $request->query('sub_cat_id', 0),
            'location' => $request->query('location', 0),
            'sublocation' => $request->query('sublocation', 0)
        ]);
    }



    public function store(Request $request)
    {
        try {
            if (!auth()->check()) {
                Log::error('User is not authenticated.');
                return redirect()->route('login')->with('error', 'You must be logged in to post an ad.');
            }

            $cat_id = $request->query('cat_id');
            $sub_cat_id = $request->query('sub_cat_id');
            $location = $request->query('location');
            $sublocation = $request->query('sublocation');
            $selectedPackageName = $request->input('selected_package_name');
            $selectedPackagePrice = $request->input('selected_package_price');
            $selectedPackageDuration = $request->input('selected_package_duration');

            Log::info('Store method called', ['request_data' => $request->all(), 'query_params' => $request->query()]);

            $formFields = FormField::all();
            $dynamicRules = [];

            foreach ($formFields as $field) {
                $dynamicRules['field_' . $field->id] = 'nullable';
            }

            if ($request->boosting_option == '0') {
                $request->merge(['package_type' => '0']);
            }

            $validationRules = array_merge([
                'title'         => 'required|string|max:255',
                'price'         => 'required|numeric',
                'description'   => 'required|string',
                'main_image'    => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg,webp,tiff|max:20480',
                'sub_images'    => 'nullable|array',
                'sub_images.*'  => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg,webp,tiff|max:20480',
                'brand'         => 'nullable',
                'model'         => 'nullable',
                'condition'     => 'nullable|in:New,Used',
                'pricing_type'  => 'nullable|in:Fixed,Negotiable,Daily,Weekly,Monthly,Yearly',
                'post_type'     => 'nullable|in:Booking,Sale,Rent',
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

            if (auth()->user()->roles === 'staff') {
                $validationRules = array_merge($validationRules, [
                    'user_first_name' => 'required|string|max:255',
                    'user_last_name' => 'required|string|max:255',
                    'user_email' => 'required|email|unique:users,email',
                    'user_phone_number' => 'required|string|max:20',
                ]);
            }

            $validated = $request->validate($validationRules);

            $userId = auth()->user()->id;
            $createdByStaffId = null;
            $userPhoneNumber = auth()->user()->phone_number;

            if (auth()->user()->roles === 'staff') {
                // Create new user
                $user = new User();
                $user->first_name = $validated['user_first_name'];
                $user->last_name = $validated['user_last_name'];
                $user->email = $validated['user_email'];
                $user->phone_number = $validated['user_phone_number'];
                $user->roles = 'user';
                $user->created_by = 2;
                $user->active_status = 1;
                $user->password = Hash::make('12345678');
                $user->save();

                $userId = $user->id;
                $createdByStaffId = auth()->user()->id;
                $userPhoneNumber = $validated['user_phone_number'];

                Log::info('New user created by staff', ['new_user_id' => $userId, 'staff_id' => $createdByStaffId]);
            }

            $packageExpireAt = null;

            if ($request->boosting_option != '0') {
                $packageType = PackageType::find($validated['package_type']);
                if ($packageType) {
                    $packageExpireAt = Carbon::now()->addDays((int)($packageType->duration));
                }
            } else {
                $packageExpireAt = Carbon::now()->addDays(30);
            }

            $manager = new ImageManager(new Driver());
            $fixedWidth = 800;
            $fixedHeight = 800;

            $watermark = $manager->read(public_path('watermarks/yaka_watermark2.png'));

            $image = $manager->read($request->file('main_image')->getPathname());
            $image->resize($fixedWidth, $fixedHeight);
            $image->place($watermark, 'center');

            $mainFile = $request->file('main_image');
            $extension = $mainFile->getClientOriginalExtension();
            $mainFilename = uniqid() . '.' . $extension;
            Storage::disk('public')->put('ads/main_images/' . $mainFilename, (string) $image->toJpeg());
            $mainImagePath = 'ads/main_images/' . $mainFilename;

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

            if ($request->boosting_option != '0') {
                $adData = $request->all();
                $adData['main_image'] = $mainImagePath;
                $adData['sub_images'] = $subImagesPaths;
                $adData['user_id'] = $userId;
                $adData['created_by_staff_id'] = $createdByStaffId;

                return redirect()->route('payment.page')
                    ->with([
                        'package_id' => $request->boosting_option,
                        'package_type' => $request->package_type,
                        'selected_package_name' => $request->input('selected_package_name'),
                        'selected_package_price' => $request->input('selected_package_price'),
                        'selected_package_duration' => $request->input('selected_package_duration'),
                        'ad_data' => $adData,
                    ]);
            }

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
                'created_by_staff_id' => $createdByStaffId
            ]);

            OtpService::sendSingleSms($userPhoneNumber, "Your ad has been successfully submitted! It will go live after admin approval. Thank you for using our platform.");

            $successMessage = auth()->user()->roles === 'staff' ?
                'User created and ad posted successfully!' :
                'Ad posted successfully!';

            return redirect()->route('user.my_ads')->with('success', $successMessage);

        } catch (Exception $e) {
            Log::error('Error in store method', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function boostingUpdate(Request $request)
    {
        try {
            // Log the incoming request data
            Log::info('Request data:', $request->all());

            // Validate the request
            $validated = $request->validate([
                'adsId' => 'required|exists:ads,adsId',
                'ads_package' => 'required|exists:table_package,id',
                'package_type' => 'required|exists:table_package_typess,id',
            ]);

            // Find the Ad using adsId
            $ad = Ads::where('adsId', $validated['adsId'])->firstOrFail();

            // Get the package type duration from the PackageType model
            $packageType = PackageType::find($validated['package_type']);

            // Check if the package type exists and calculate the expiration date
            if ($packageType) {
                $packageExpireAt = Carbon::now()->addDays($packageType->duration);
            } else {
                // If no packageType found, handle the error or use default value
                throw new Exception('Package type not found');
            }

            // Update the Ad with new package details
            $ad->update([
                'ads_package' => $validated['ads_package'],
                'package_type' => $validated['package_type'],
                'package_expire_at' => $packageExpireAt,
            ]);

            // Log successful update
            Log::info('Ad boosting updated successfully', ['adsId' => $ad->adsId]);

            // Return success response
            return response()->json(['success' => true, 'message' => 'Ad boosting updated successfully!']);
        } catch (Exception $e) {
            // Log the error message
            Log::error('Error in boosting update', ['error' => $e->getMessage()]);

            // Return error response
            return response()->json(['success' => false, 'message' => 'Something went wrong! Please try again.'], 500);
        }
    }
}
