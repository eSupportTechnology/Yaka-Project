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
        return response()->json($category->subcategories);
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
    
        $models = collect();
        
        if ($request->brand) {
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

            // Log the extracted data for debugging
            Log::info('Store method called', ['request_data' => $request->all(), 'query_params' => $request->query()]);
            
            $formFields = FormField::all();
            $dynamicRules = [];
    
            foreach ($formFields as $field) {
                $dynamicRules['field_' . $field->id] = 'nullable';
            }
    
            // Merge validation rules
            $validationRules = array_merge([
                'title'         => 'required|string|max:255',
                'price'         => 'required|numeric',
                'description'   => 'required|string',
                'main_image'    => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'sub_images.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'brand'         => 'nullable',
                'model'         => 'nullable',
                'condition'     => 'nullable|in:New,Used',
                'pricing_type'  => 'nullable|in:Fixed,Negotiable,Daily,Weekly,Monthly,Yearly',
                'post_type'     => 'nullable|in:Booking,Sale,Rent',
                'boosting_option' => [
    'required',
    function ($attribute, $value, $fail) {
        // Allow 0 for Free Ads
        if ($value == '0') {
            return;
        }
        // Otherwise, check if the value exists in the table_package
        $package = \App\Models\Package::find($value);
        if (!$package) {
            $fail('The selected boosting option is invalid.');
        }
    }
],
'package_type' => [
    'required_unless:boosting_option,0',
    function ($attribute, $value, $fail) {
        if (request('boosting_option') == '0' && $value != '0') {
            $fail('The package type must be 0 when selecting a Free Ad.');
        }
    },
    'exists:table_package_typess,id'
],

            ], $dynamicRules);
            
            // Validate the request data
            $validated = $request->validate($validationRules);
    
            $mainImagePath = $request->file('main_image')->storeAs('ads/main_images', 
            $request->file('main_image')->getClientOriginalName(), 'public');

            // Handle sub images upload with original file names
            $subImagesPaths = [];
            if ($request->hasFile('sub_images')) {
                foreach ($request->file('sub_images') as $file) {
                    $subImagesPaths[] = $file->storeAs('ads/sub_images', $file->getClientOriginalName(), 'public');
                }
            }

    
            // Create the Ad
            $ad = Ads::create([
                'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'user_id' => auth()->user()->id, // Ensure user ID is set correctly
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
    
    
    
}
