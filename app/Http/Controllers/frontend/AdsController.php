<?php

namespace App\Http\Controllers\frontend;

use App\Models\AdDetail;
use App\Models\FormField;
use App\Models\User;
use App\Services\OtpService;
use Carbon\Carbon;
use App\Models\Ads;
use App\Models\City;
use App\Models\Cities;
use App\Models\Banners;
use App\Models\Package;
use App\Models\Category;
use App\Models\Districts;
use App\Models\PackageType;
use App\Models\PaymentInfo;
use App\Models\BrandsModels;
use Exception;
use Illuminate\Http\Request;
use App\Services\IpgHashService;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{


    public function browseAds(Request $request)
    {
        $locale = App::getLocale();
        $searchName = 'name_' . $locale;
        // Get selected filters from the request
        $selectedLocation = $request->input('location');
        $selectedCity = $request->input('city');
        $selectedCategory = $request->input('category');
        $selectedSubCategory = $request->input('subcategory');
        $searchTerm = $request->input('search-field');

        $selectedCityName = 'Locations';
        $selectedCategoryName = 'Categories';
        if (!empty($selectedCity)) {
            $city = City::find($selectedCity);
            if ($city) {
                $selectedCityName = $city->$searchName;
            }
        }
        if (!empty($selectedCategory)) {
            $cat = Category::where('mainId', $selectedCategory)->first();
            if ($cat) $selectedCategoryName = $cat->name;
        }

        $categories = Category::where('mainId', 0)->get();
        $districts = Districts::all();
        $citys = Cities::all();

        // Build base superAds query and apply category + location/city filters
        $superAdsQuery = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->where('ads_package', 6)
            ->where('status', 1)
            ->where(function ($query) {
                $query->whereNull('package_expire_at')
                    ->orWhere('package_expire_at', '>=', now());
            });

        if (!empty($selectedCategory)) {
            $superAdsQuery->where('cat_id', $selectedCategory);
        }

        // If city provided, narrow by city (and optionally by district if both provided)
        if (!empty($selectedCity)) {
            $superAdsQuery->where('sublocation', $selectedCity);
            if (!empty($selectedLocation)) {
                $superAdsQuery->where('location', $selectedLocation);
            }
        } elseif (!empty($selectedLocation)) {
            // only district provided
            $superAdsQuery->where('location', $selectedLocation);
        }

        $superAds = $superAdsQuery->latest()->get();

        // Base query for all ads
        $baseQuery = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->where('status', 1)
            ->where(function ($query) {
                $query->whereNull('package_expire_at')
                    ->orWhere('package_expire_at', '>=', Carbon::now());
            });

        // Apply filters: prefer city filter when present, otherwise district
        $applyFilters = function ($query) use ($selectedLocation, $selectedCity, $selectedCategory, $selectedSubCategory, $searchTerm) {
            if (!empty($selectedCity)) {
                $query->where('sublocation', $selectedCity);
                if (!empty($selectedLocation)) {
                    $query->where('location', $selectedLocation);
                }
            } elseif (!empty($selectedLocation)) {
                $query->where('location', $selectedLocation);
            }

            if (!empty($selectedCategory)) {
                $query->where('cat_id', $selectedCategory);
            }

            if (!empty($selectedSubCategory)) {
                $query->where('sub_cat_id', $selectedSubCategory);
            }

            if (!empty($searchTerm)) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('description', 'like', "%{$searchTerm}%");
                });
            }

            return $query;
        };

        // Prepare and merge all packages in custom order
        $ads = collect();

        // ads_package = 6
        $ads = $ads->merge(
            $applyFilters((clone $baseQuery)->where('ads_package', 6))
                ->orderBy('rotation_position', 'asc')
                ->get()
        );

        // ads_package = 3
        $ads = $ads->merge(
            $applyFilters((clone $baseQuery)->where('ads_package', 3))
                ->orderBy('rotation_position', 'asc')
                ->get()
        );

        // ads_package = 4
        $ads = $ads->merge(
            $applyFilters((clone $baseQuery)->where('ads_package', 4))
                ->orderBy('rotation_position', 'asc')
                ->get()
        );

        // ads_package = 5
        $ads = $ads->merge(
            $applyFilters((clone $baseQuery)->where('ads_package', 5))
                ->orderBy('rotation_position', 'asc')
                ->get()
        );

        // ads_package = 0 (normal ads)
        $ads = $ads->merge(
            $applyFilters((clone $baseQuery)->where('ads_package', 0))
                ->orderBy('created_at', 'desc')
                ->get()
        );

        $page = request()->get('page', 1);
        $perPage = 30;

        $pagedAds = new LengthAwarePaginator(
            $ads->forPage($page, $perPage),
            $ads->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        $ads = $pagedAds;

        $category = Category::find($selectedCategory);

        $banners = Banners::where('type', 1)->get();

        $all_banners = Banners::where('type', 0)->get();

        return view('newFrontend.browse-ads', compact('categories', 'superAds', 'all_banners', 'ads', 'districts', 'banners', 'category', 'citys', 'selectedCityName', 'selectedCategoryName'));
    }

    public function show_details($adsId)
    {
        // Fetch the ad details with eager loading for the related data
        $ad = Ads::where('adsId', $adsId)
            ->with(['main_location', 'sub_location', 'user', 'category'])
            ->firstOrFail();

        // Manually fetch the brand and model based on the brand and model IDs
        $brand = BrandsModels::find($ad->brand);
        $model = BrandsModels::find($ad->model);

        $mainImage = $ad->mainImage;
        $subImages = json_decode($ad->subImage, true);

        $ad->view_count += 1;
        $ad->save();

        // Fetch banners
        $banners = Banners::where('type', 0)->get();
        $otherbanners = Banners::where('type', 1)->get();

        $relatedAds = Ads::where('adsId', '!=', $ad->adsId)
            ->where(function ($query) use ($ad) {
                $query->where('cat_id', $ad->cat_id)
                    ->where('sub_cat_id', $ad->sub_cat_id)
                    ->where('location', $ad->location);
            })
            ->where(function ($query) {
                $query->whereNull('package_expire_at')
                    ->orWhere('package_expire_at', '>=', Carbon::now());
            })
            ->latest()
            ->take(12)
            ->get();

        if ($relatedAds->count() < 12) {
            $additionalAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where(function ($query) use ($ad) {
                    $query->where('cat_id', $ad->cat_id)
                        ->where('sub_cat_id', $ad->sub_cat_id);
                })
                ->latest()
                ->take(12 - $relatedAds->count())
                ->get();
            $relatedAds = $relatedAds->merge($additionalAds);
        }

        if ($relatedAds->count() < 12) {
            $additionalAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where(function ($query) use ($ad) {
                    $query->where('cat_id', $ad->cat_id)
                        ->where('location', $ad->location);
                })
                ->latest()
                ->take(12 - $relatedAds->count())
                ->get();
            $relatedAds = $relatedAds->merge($additionalAds);
        }

        if ($relatedAds->count() < 12) {
            $additionalAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where('cat_id', $ad->cat_id)
                ->latest()
                ->take(12 - $relatedAds->count())
                ->get();
            $relatedAds = $relatedAds->merge($additionalAds);
        }

        if ($relatedAds->count() < 12) {
            $additionalAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where('location', $ad->location)
                ->latest()
                ->take(12 - $relatedAds->count())
                ->get();
            $relatedAds = $relatedAds->merge($additionalAds);
        }


        return view('newFrontend.browse-ads-details', compact('ad', 'banners', 'mainImage', 'subImages', 'otherbanners', 'relatedAds', 'brand', 'model'));
    }

    





    public function ads_boost($adsId)
    {
        $ad = Ads::findOrFail($adsId);
        $packages = Package::all(); // Fetch all packages
        $packageTypes = PackageType::all(); // Fetch all package types
        $invoiceId = "YKAD" . date('YmsHsi');

        session(['invoiceId' => $invoiceId]);

        $mainImage = $ad->mainImage;



        return view('newFrontend.ads_boost_plans', compact('ad', 'mainImage', 'packages', 'packageTypes', 'invoiceId'));
    }





    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        $ads = Ads::with(['category', 'subcategory', 'main_location'])
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->orWhereHas('category', function ($q) use ($query) {
                        $q->where('name', 'like', "%$query%");
                    })
                    ->orWhereHas('subcategory', function ($q) use ($query) {
                        $q->where('name', 'like', "%$query%");
                    });
            })
            ->where('status', '1') // this now applies to the whole group
            ->get();


        return view('newFrontend.search-results', compact('ads')); // Adjust the view path if necessary
    }

    public function apiStore(Request $request)
    {
        try {
            // Log all incoming API data
            Log::info('=== API FRONTEND DATA RECEIVED ===', [
                'timestamp' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'all_data' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            // Get user_id from request
            $userId = $request->input('user_id');

            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'user_id is required'
                ], 400);
            }

            // Verify user exists
            $user = User::find($userId);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid user_id provided'
                ], 404);
            }

            Log::info('API User Verification', [
                'user_id' => $userId,
                'user_name' => $user->first_name . ' ' . $user->last_name,
                'user_role' => $user->roles
            ]);

            $formFields = FormField::all();
            $dynamicRules = [];

            foreach ($formFields as $field) {
                $dynamicRules['field_' . $field->id] = 'nullable';
            }

            // Handle boosting option
            if ($request->boosting_option == '0' || !$request->boosting_option) {
                $request->merge(['package_type' => '0']);
            }

            // Validation rules for API
            $validationRules = array_merge([
                'user_id'       => 'required|exists:users,id',
                'title'         => 'required|string|max:255',
                'price'         => 'required|numeric',
                'description'   => 'required|string',
                'brand'         => 'nullable',
                'model'         => 'nullable',
                'condition'     => 'nullable|in:New,Used',
                'pricing_type'  => 'nullable|in:Fixed,Negotiable,Daily,Weekly,Monthly,Yearly',
                'post_type'     => 'nullable|in:Booking,Sale,Rent',
                'boosting_option' => [
                    'nullable',
                    function ($attribute, $value, $fail) {
                        if ($value && $value != '0') {
                            if (!Package::find($value)) {
                                $fail('The selected boosting option is invalid.');
                            }
                        }
                    }
                ],
                'package_type' => [
                    'nullable',
                    function ($attribute, $value, $fail) {
                        if (request('boosting_option') && request('boosting_option') != '0' && $value) {
                            if (!PackageType::where('id', $value)->exists()) {
                                $fail('The selected package type is invalid.');
                            }
                        }
                    }
                ],
                'cat_id'        => 'required|string',
                'sub_cat_id'    => 'required|string',
                'location'      => 'required|string',
                'sublocation'   => 'required|string',
                'experience_years' => 'nullable|integer|min:0',
                'education' => 'nullable|string|max:255',
                'application_deadline' => 'nullable|date',
                'mobile_number' => 'nullable|string|max:20',
                // Image handling for API (base64 or URLs)
                'main_image_base64' => 'nullable|string',
                'main_image_url' => 'nullable|url',
                'sub_images_base64' => 'nullable|array',
                'sub_images_urls' => 'nullable|array',
            ], $dynamicRules);

            // Additional validation for staff users
            if ($user->roles === 'staff') {
                $validationRules = array_merge($validationRules, [
                    'target_user_first_name' => 'nullable|string|max:255',
                    'target_user_last_name' => 'nullable|string|max:255',
                    'target_user_phone_number' => 'nullable|string|max:10',
                ]);
            }

            $validated = $request->validate($validationRules);

            Log::info('=== API VALIDATED DATA ===', [
                'user_id' => $userId,
                'validated_data' => $validated
            ]);

            $targetUserId = $userId;
            $createdByStaffId = null;
            $userPhoneNumber = $user->phone_number;

            // Handle staff creating ads for other users
            if ($user->roles === 'staff' && $request->target_user_phone_number) {
                $targetUser = User::where('phone_number', $request->target_user_phone_number)->first();

                if ($targetUser) {
                    $targetUserId = $targetUser->id;
                    Log::info('API Staff - Existing target user found', ['target_user_id' => $targetUserId]);
                } else if ($request->target_user_first_name && $request->target_user_last_name) {
                    // Create new user
                    $newUser = User::create([
                        'first_name' => $request->target_user_first_name,
                        'last_name' => $request->target_user_last_name,
                        'email' => $request->target_user_email ?? 'N/A',
                        'phone_number' => $this->makeMobileNumberFormat($request->target_user_phone_number),
                        'roles' => 'user',
                        'created_by' => 2,
                        'active_status' => 1,
                        'password' => Hash::make('12345678'),
                    ]);

                    $targetUserId = $newUser->id;
                    Log::info('API Staff - New target user created', ['target_user_id' => $targetUserId]);
                }

                $createdByStaffId = $userId;
                $userPhoneNumber = $request->target_user_phone_number;
            }

            // Calculate package expiry
            $packageExpireAt = null;
            if ($request->boosting_option && $request->boosting_option != '0') {
                $packageType = PackageType::find($request->package_type);
                if ($packageType) {
                    $packageExpireAt = Carbon::now()->addDays((int)($packageType->duration));
                }
            } else {
                $packageExpireAt = Carbon::now()->addDays(30);
            }

            // Handle images (for API, you might want to handle base64 or URLs)
            $mainImagePath = null;
            $subImagesPaths = [];

            // Handle main image
            if ($request->main_image_base64) {
                $mainImagePath = $this->saveBase64Image($request->main_image_base64, 'ads/main_images/');
            } elseif ($request->main_image_url) {
                $mainImagePath = $this->saveImageFromUrl($request->main_image_url, 'ads/main_images/');
            }

            // Handle sub images
            if ($request->sub_images_base64) {
                foreach ($request->sub_images_base64 as $base64Image) {
                    $imagePath = $this->saveBase64Image($base64Image, 'ads/sub_images/');
                    if ($imagePath) {
                        $subImagesPaths[] = $imagePath;
                    }
                }
            } elseif ($request->sub_images_urls) {
                foreach ($request->sub_images_urls as $imageUrl) {
                    $imagePath = $this->saveImageFromUrl($imageUrl, 'ads/sub_images/');
                    if ($imagePath) {
                        $subImagesPaths[] = $imagePath;
                    }
                }
            }

            // For paid packages, you might want to handle payment differently in API
            if ($request->boosting_option && $request->boosting_option != '0') {
                Log::info('=== API PAID PACKAGE DATA ===', [
                    'package_id' => $request->boosting_option,
                    'package_type' => $request->package_type,
                    'user_id' => $targetUserId
                ]);

                // For API, you might want to create the ad directly or return payment info
                // This example creates the ad directly - modify based on your payment flow
            }

            $brand = $validated['brand'] ?? 'no brand';
            $model = $validated['model'] ?? 'no model';

            // Prepare final ad data
            $finalAdData = [
                'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'user_id' => $targetUserId,
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
                'ads_package' => $request->boosting_option ?? '0',
                'package_type' => $request->package_type ?? '0',
                'package_expire_at' => $packageExpireAt,
                'cat_id' => $validated['cat_id'],
                'sub_cat_id' => $validated['sub_cat_id'],
                'location' => $validated['location'],
                'sublocation' => $validated['sublocation'],
                'status' => '0',
                'experience_years' => $request->input('experience_years'),
                'education' => $request->input('education'),
                'application_deadline' => $request->input('application_deadline'),
                'mobile_number' => $request->input('mobile_number'),
                'rotation_position' => -1,
                'last_rotated_at' => now(),
            ];

            Log::info('=== API FINAL DATA TO SAVE ===', [
                'final_ad_data' => $finalAdData
            ]);

            $ad = Ads::create($finalAdData);

            // Save additional form field data
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

            Log::info('=== API DATA SUCCESSFULLY SAVED ===', [
                'ad_id' => $ad->adsId,
                'user_id' => $targetUserId,
                'created_by_staff_id' => $createdByStaffId
            ]);

            // Send SMS notification
            if ($user->roles != 'staff') {
                OtpService::sendSingleSms($userPhoneNumber, "Your ad has been successfully submitted! It will go live after admin approval. Thank you for using our platform.");
            }

            return response()->json([
                'success' => true,
                'message' => 'Ad posted successfully!',
                'data' => [
                    'ad_id' => $ad->adsId,
                    'title' => $ad->title,
                    'price' => $ad->price,
                    'status' => $ad->status,
                    'package_expire_at' => $ad->package_expire_at
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('API Validation Error', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('API Error in store method', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong! Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Helper method to save base64 image
    private function saveBase64Image($base64String, $path)
    {
        try {
            // Remove data:image/jpeg;base64, part if present
            if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $type)) {
                $base64String = substr($base64String, strpos($base64String, ',') + 1);
                $extension = strtolower($type[1]);
            } else {
                $extension = 'jpg'; // default
            }

            $imageData = base64_decode($base64String);

            if ($imageData === false) {
                return null;
            }

            $filename = uniqid() . '.' . $extension;
            $fullPath = $path . $filename;

            Storage::disk('public')->put($fullPath, $imageData);

            return $fullPath;
        } catch (Exception $e) {
            Log::error('Error saving base64 image', ['error' => $e->getMessage()]);
            return null;
        }
    }

    // Helper method to save image from URL
    private function saveImageFromUrl($imageUrl, $path)
    {
        try {
            $imageData = file_get_contents($imageUrl);

            if ($imageData === false) {
                return null;
            }

            $extension = pathinfo($imageUrl, PATHINFO_EXTENSION) ?: 'jpg';
            $filename = uniqid() . '.' . $extension;
            $fullPath = $path . $filename;

            Storage::disk('public')->put($fullPath, $imageData);

            return $fullPath;
        } catch (Exception $e) {
            Log::error('Error saving image from URL', ['error' => $e->getMessage(), 'url' => $imageUrl]);
            return null;
        }
    }
}
