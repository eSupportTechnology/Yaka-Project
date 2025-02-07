<?php

namespace App\Http\Controllers\frontend;

use App\Models\Ads;
use App\Models\Category;
use App\Models\Banners;
use App\Models\Cities;
use App\Models\Districts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    //show ads
    public function adshow()
    {
        $ads = Ads::latest()->take(6)->get();
        return view('newFrontend.index', compact('ads'));
    }

    public function someFunction(){
        $adsCount = Ad::count();
        echo "Total ads:";
    }
  

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
        $topAds = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->where('ads_package', 3)
            ->latest()
            ->get();

        $adsQuery = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->orderByRaw('CASE 
                WHEN ads_package = 4 THEN 1 
                WHEN ads_package = 5 THEN 2 
                ELSE 3 
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

        return view('newFrontend.browse-ads', compact('categories', 'topAds', 'ads', 'districts', 'banners', 'category'));
    }

    
    
    public function show_details($ad_id)
    {
        // Fetch the ad by its ID and eager load related models
        $ad = Ads::with(['main_location', 'sub_location', 'user', 'category'])->findOrFail($ad_id);
    
        $mainImage = $ad->main_image;
        $subImages = $ad->sub_images;
    
        // Increment view count
        $ad->view_counr += 1;
        $ad->save();  
    
        // Fetch banners
        $banners = Banners::where('type', 0)->get();
        $otherbanners = Banners::where('type', 1)->get();
    
        // Fetch related ads with the same category and location
        $relatedAds = Ads::where('id', '!=', $ad->id)
            ->where('cat_id', $ad->cat_id)
            ->where('location', $ad->location)
            ->latest()
            ->take(12)
            ->get();
    
        if ($relatedAds->isEmpty()) {
            $relatedAds = Ads::where('id', '!=', $ad->id)
                ->where('cat_id', $ad->cat_id)
                ->latest()
                ->take(12)
                ->get();
        }
    
        return view('newFrontend.browse-ads-details', compact('ad', 'banners', 'mainImage', 'subImages', 'otherbanners', 'relatedAds'));
    }
    


    
}
