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
    
        // Fetch urgent ads based on the selected category and package expiry date check
        $urgentAdsQuery = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->where('ads_package', 4) 
            ->where('status', 1)
            ->where(function($query) {
                $query->whereNull('package_expire_at') 
                      ->orWhere('package_expire_at', '>=', now()); 
            })
            ->latest();
    
        if (!empty($selectedCategory)) {
            $urgentAdsQuery->where('cat_id', $selectedCategory);
        }
    
        $urgentAds = $urgentAdsQuery->get();
    
        $adsQuery = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->where('status', 1)  
            ->orderByRaw('CASE 
                WHEN ads_package = 3 THEN 1 
                WHEN ads_package = 6 THEN 2 
                WHEN ads_package = 5 THEN 2 
                ELSE 4 
            END')
            ->latest();
    

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
    
        $ads = $adsQuery->paginate(12);
    
        $category = Category::find($selectedCategory);
    
        $banners = Banners::where('type', 1)->get();
    
        return view('newFrontend.browse-ads', compact('categories', 'urgentAds', 'ads', 'districts', 'banners', 'category'));
    }
    

    
    
    public function show_details($adsId)
    {
        $ad = Ads::where('adsId', $adsId)->with(['main_location', 'sub_location', 'user', 'category'])->firstOrFail();
    
        $mainImage = $ad->mainImage;
        $subImages = json_decode($ad->subImage, true);
    
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
    

    public function ads_boost($adsId)
    {
        $ad = Ads::findOrFail($adsId); 
        $packages = Package::all(); // Fetch all packages
        $packageTypes = PackageType::all(); // Fetch all package types

        $mainImage = $ad->mainImage;
    
        return view('newFrontend.ads_boost_plans', compact('ad', 'mainImage', 'packages', 'packageTypes'));
    }

 
 
    
    

    
    

    
}
