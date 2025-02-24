<?php

namespace App\Http\Controllers\frontend;

use App\Models\Ads;
use App\Models\Category;
use App\Models\Banners;
use App\Models\Cities;
use App\Models\Districts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageType;

class AdsController extends Controller
{
  

    public function browseAds(Request $request)
    {
        // Get selected filters from the request
        $selectedLocation = $request->input('location');
        $selectedCategory = $request->input('category'); 
        $selectedSubCategory = $request->input('subcategory'); 
        $searchTerm = $request->input('search-field');

        $categories = Category::where('mainId', 0)->get();
        $districts = Districts::all();

        // Fetch top ads
        $urgentAds = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->where('ads_package', 4)
            ->latest()
            ->get();

        $adsQuery = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->orderByRaw('CASE 
                WHEN ads_package = 3 THEN 1 
                WHEN ads_package = 6 THEN 2 
                WHEN ads_package = 5 THEN 2 
                ELSE 4 
            END')
            ->latest();

        // Apply filters with correct column names
        if (!empty($selectedLocation)) {
            $adsQuery->where(function ($query) use ($selectedLocation) {
                $query->where('location', $selectedLocation)
                    ->orWhere('sublocation', $selectedLocation);
            });
        }

        if (!empty($selectedCategory)) {
            $adsQuery->where('cat_id', $selectedCategory);
        }

        if (!empty($selectedSubCategory)) {
            $adsQuery->where('sub_cat_id', $selectedSubCategory);
        }

        if (!empty($searchTerm)) {
            $adsQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Paginate the results
        $ads = $adsQuery->paginate(12);

        // Get the selected category for displaying its name in the view
        $category = Category::find($selectedCategory);

        // Fetch banners
        $banners = Banners::where('type', 1)->get();

        return view('newFrontend.browse-ads', compact('categories', 'urgentAds', 'ads', 'districts', 'banners', 'category'));
    }

    
    
    public function show_details($adsId)
    {
        $ad = Ads::where('adsId', $adsId)->with(['main_location', 'sub_location', 'user', 'category'])->firstOrFail();
    
        $mainImage = $ad->main_image;
        $subImages = $ad->sub_images;
    
        $ad->view_count += 1; 
        $ad->save();
    
        // Fetch banners
        $banners = Banners::where('type', 0)->get();
        $otherbanners = Banners::where('type', 1)->get();
    
        // Fetch related ads
        $relatedAds = Ads::where('adsId', '!=', $ad->adsId)
            ->where('cat_id', $ad->cat_id)
            ->where('location', $ad->location)
            ->latest()
            ->take(12)
            ->get();
    
        if ($relatedAds->isEmpty()) {
            $relatedAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where('cat_id', $ad->cat_id)
                ->latest()
                ->take(12)
                ->get();
        }
    
        return view('newFrontend.browse-ads-details', compact('ad', 'banners', 'mainImage', 'subImages', 'otherbanners', 'relatedAds'));
    }
    

    public function ads_boost($ad_id)
    {
        $ad = Ads::findOrFail($ad_id); 
        $packages = Package::all(); // Fetch all packages
        $packageTypes = PackageType::all(); // Fetch all package types

        $mainImage = $ad->main_image;
    
        return view('newFrontend.ads_boost_plans', compact('ad', 'mainImage', 'packages', 'packageTypes'));
    }

 
 
    
    

    
    

    
}
