<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Ads;
use App\Models\Category;
use App\Models\Districts;
use Illuminate\Http\Request;

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
        if ($request->id) {
            $subcategories = \App\Models\Category::where('mainId', $request->id)->get();
        }
    
        $brands = collect();
        if ($request->subcategory_id) {
            $brands = \App\Models\BrandsModels::where('sub_cat_id', $request->subcategory_id)
                        ->where('brandsId', 0)
                        ->get();
        }
    
        $models = collect();
        if ($request->brand) {
            $models = \App\Models\BrandsModels::where('brandsId', $request->brand)->get();
        }
    
        // Retrieve districts
        $districts = \App\Models\Districts::with('cities')->get();
    
        return view('newFrontend.user.ad_posts', compact('categories', 'subcategories', 'brands', 'models', 'districts'));
    }
    
}
