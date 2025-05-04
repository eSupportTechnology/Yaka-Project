<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Ads;
use App\Models\AdDetail;
use App\Models\FormField;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\Category;
use App\Models\Districts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserAdsController extends Controller
{

    public function ad_posts_categories(Request $request)
    {
        $categories = \App\Models\Category::where('status', 1)
            ->where('mainId', 0)
            ->with(['subcategories' => function($query) {
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
        $districts = \App\Models\Districts::with('cities')->get();
        return view('newFrontend.user.ad_posts_location', compact('districts'));
    }

    public function fetchCities($districtId)
    {
        // Fetch cities related to the district
        $district = \App\Models\Districts::with('cities')->find($districtId);
        if ($district) {
            return response()->json($district->cities);
        }
        return response()->json([]);
    }


    public function ad_posts(Request $request)
    {
        $categories = \App\Models\Category::where('status', 1)->where('mainId', 0)->get();

        $subcategories = collect();
        if ($request->cat_id) {
            $subcategories = \App\Models\Category::where('mainId', $request->cat_id)->get();
        }

        $brands = collect();
        if ($request->sub_cat_id) {
            $brands = \App\Models\BrandsModels::where('sub_cat_id', $request->sub_cat_id)
                        ->where('brandsId', 0)
                        ->get();
        }

        // Get models based on brandId and subCatId
        $models = collect();
        if ($request->brand && $request->sub_cat_id) {
            $models = \App\Models\BrandsModels::where('brandsId', $request->brand)
                        ->where('sub_cat_id', $request->sub_cat_id)
                        ->get();
        }

        $formFields = \App\Models\FormField::where('main_category_id', $request->cat_id)
                        ->where('subcategory_id', $request->sub_cat_id)
                        ->get();

        $packages = \App\Models\Package::with('packageTypes')
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
        // Check if user is authenticated
        if (!auth()->check()) {
            Log::error('User is not authenticated.');
            return redirect()->route('login')->with('error', 'You must be logged in to post an ad.');
        }

        // Extract query parameters
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

        // Validation rules
        $validationRules = array_merge([
            'title'         => 'required|string|max:255',
            'price'         => 'required|numeric',
            'description'   => 'required|string',
            'main_image'    => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'sub_images'    => 'nullable|array',
            'sub_images.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
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
                    if (!\App\Models\Package::find($value)) {
                        $fail('The selected boosting option is invalid.');
                    }
                }
            ],
            'package_type' => [
                'required_unless:boosting_option,0',
                function ($attribute, $value, $fail) {
                    if (request('boosting_option') != '0' && !\App\Models\PackageType::where('id', $value)->exists()) {
                        $fail('The selected package type is invalid.');
                    }
                }
            ],
        ], $dynamicRules);

        // Validate the request data
        $validated = $request->validate($validationRules);



        // If Free Ad, Save Directly
       // return $this->saveAd($validated, $cat_id, $sub_cat_id, $location, $sublocation);

            // Get the package type duration
            $packageExpireAt = null; // Default null value

            if ($request->boosting_option != '0') {
                $packageType = \App\Models\PackageType::find($validated['package_type']);
                if ($packageType) {
                    $packageExpireAt = Carbon::now()->addDays($packageType->duration);
                }
            }

            $mainImagePath = $request->file('main_image')->storeAs('ads/main_images',
            $request->file('main_image')->getClientOriginalName(), 'public');

            $subImagesPaths = [];

            if ($request->hasFile('sub_images')) {
                foreach ($request->file('sub_images') as $file) {
                    if ($file->isValid()) { // Ensure the file is valid
                        $path = $file->storeAs('ads/sub_images', $file->getClientOriginalName(), 'public');
                        $subImagesPaths[] = $path; // Add the path to the array
                    }
                }
            }

            // Check if it's a paid ad
                    if ($request->boosting_option != '0') {
                        // Merge the image paths into the ad data
                        $adData = $request->all();
                        $adData['main_image'] = $mainImagePath;
                        $adData['sub_images'] = $subImagesPaths;

                        // Redirect user to payment page
                        // return redirect()->route('payment.page', [
                        //     'package_id' => $request->boosting_option,
                        //     'package_type' => $request->package_type,
                        //     'selected_package_name' => $request->input('selected_package_name'),
                        //     'selected_package_price' => $request->input('selected_package_price'),
                        //     'selected_package_duration' => $request->input('selected_package_duration'),

                        //     'ad_data' => json_encode($adData), // Pass ad data for later use
                        // ]);
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


            // Create the Ad with package expiration date
            $ad = Ads::create([
                'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'user_id' => auth()->user()->id,
                'title'         => $validated['title'],
                'price'         => $validated['price'],
                'description'   => $validated['description'],
                'mainImage'     => $mainImagePath,
                'subImage'      => json_encode($subImagesPaths),
                'brand'         => $validated['brand'],
                'model'         => $validated['model'],
                'price_type'    => $validated['pricing_type'] ?? null,
                'post_type'     => $validated['post_type'] ?? null,
                'condition'     => $validated['condition'] ?? null,
                'ads_package'   => $request->boosting_option,
                'package_type'  => $request->package_type,
                'package_expire_at' => $packageExpireAt,
                'cat_id'        => $cat_id,
                'sub_cat_id'    => $sub_cat_id,
                'location'      => $location,
                'sublocation'   => $sublocation,
                'status'        => '0',
            ]);

            foreach ($formFields as $field) {
                $inputName = 'field_' . $field->id;
                $fieldValue = $request->input($inputName);

                // Only insert if the value is not null or empty
                if (!is_null($fieldValue) && $fieldValue !== '') {
                    AdDetail::create([
                        'adsId'            => $ad->adsId,
                        'additional_info'  => $field->field_name,
                        'value'            => $fieldValue
                    ]);
                }
            }
            Log::info('Ad details saved successfully');

            return redirect()->route('user.my_ads')->with('success', 'Ad posted successfully!');
    } catch (\Exception $e) {
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
        $packageType = \App\Models\PackageType::find($validated['package_type']);

        // Check if the package type exists and calculate the expiration date
        if ($packageType) {
            $packageExpireAt = Carbon::now()->addDays($packageType->duration);
        } else {
            // If no packageType found, handle the error or use default value
            throw new \Exception('Package type not found');
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
    } catch (\Exception $e) {
        // Log the error message
        Log::error('Error in boosting update', ['error' => $e->getMessage()]);

        // Return error response
        return response()->json(['success' => false, 'message' => 'Something went wrong! Please try again.'], 500);
    }
}




}
