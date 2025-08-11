<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\FormField;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\AdDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\ApiResponseService;
use Intervention\Image\ImageManager;

class UserAdsApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function store(Request $request)
    {
        try {
            $cat_id = $request->input('cat_id');
            $sub_cat_id = $request->input('sub_cat_id');
            $location = $request->input('location');
            $sublocation = $request->input('sublocation');
            $boosting_option = $request->input('boosting_option', '0');
            $package_type = $request->input('package_type');

            $formFields = FormField::all();
            $dynamicRules = [];
            foreach ($formFields as $field) {
                $dynamicRules['field_' . $field->id] = 'nullable';
            }

            $validationRules = array_merge([
                'title'         => 'required|string|max:255',
                'price'         => 'required|numeric',
                'description'   => 'required|string',
                'main_image'    => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg,webp,tiff|max:20480',
                'sub_images'    => 'nullable|array',
                'sub_images.*'  => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg,webp,tiff|max:20480',
                'brand'         => 'nullable|string',
                'model'         => 'nullable|string',
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


            $validated = $request->validate($validationRules);

            $userId = $request->input('user_id', null);
            $packageExpireAt = null;
            if ($boosting_option != '0') {
                $packageTypeModel = PackageType::find($package_type);
                if ($packageTypeModel) {
                    $packageExpireAt = Carbon::now()->addDays((int)$packageTypeModel->duration);
                }
            } else {
                $packageExpireAt = Carbon::now()->addDays(30);
            }

            $manager = new ImageManager(['driver' => 'gd']);
            $fixedWidth = 800;
            $fixedHeight = 800;
            $watermark = $manager->make(public_path('watermarks/yaka_watermark2.png'));

            $image = $manager->make($request->file('main_image')->getPathname())
                ->resize($fixedWidth, $fixedHeight)
                ->insert($watermark, 'center');
            $mainFilename = uniqid() . '.' . $request->file('main_image')->getClientOriginalExtension();
            Storage::disk('public')->put('ads/main_images/' . $mainFilename, (string)$image->encode('jpg'));

            $mainImagePath = 'ads/main_images/' . $mainFilename;

            $subImagesPaths = [];
            if ($request->hasFile('sub_images')) {
                foreach ($request->file('sub_images') as $file) {
                    if ($file->isValid()) {
                        $img = $manager->make($file->getPathname())
                            ->resize($fixedWidth, $fixedHeight)
                            ->insert($watermark, 'center');
                        $filename = uniqid() . '_' . $file->getClientOriginalName();
                        Storage::disk('public')->put('ads/sub_images/' . $filename, (string)$img->encode('jpg'));
                        $subImagesPaths[] = 'ads/sub_images/' . $filename;
                    }
                }
            }

            $adData = [
                'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'user_id' => $userId,
                'created_by_staff_id' => null,
                'title' => $validated['title'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'mainImage' => $mainImagePath,
                'subImage' => json_encode($subImagesPaths),
                'brand' => $validated['brand'] ?? 'no brand',
                'model' => $validated['model'] ?? 'no model',
                'price_type' => $validated['pricing_type'] ?? null,
                'post_type' => $validated['post_type'] ?? null,
                'condition' => $validated['condition'] ?? null,
                'ads_package' => $boosting_option,
                'package_type' => $package_type,
                'package_expire_at' => $packageExpireAt,
                'cat_id' => $cat_id,
                'sub_cat_id' => $sub_cat_id,
                'location' => $location,
                'sublocation' => $sublocation,
                'status' => '0',
                'experience_years' => $validated['experience_years'] ?? null,
                'education' => $validated['education'] ?? null,
                'application_deadline' => $validated['application_deadline'] ?? null,
                'mobile_number' => $validated['mobile_number'] ?? null,
                'rotation_position' => -1,
                'last_rotated_at' => now(),
            ];

            $ad = Ads::create($adData);

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
            ]);


            return $this->apiResponse->success([
                'ad_id' => $ad->adsId,
                'message' => 'Ad posted successfully and pending admin approval.'
            ]);

        } catch (Exception $e) {
            Log::error('Error posting ad: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return $this->apiResponse->error(null, 'Something went wrong! Please try again.', 500);
        }
    }

}
