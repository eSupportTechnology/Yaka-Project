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
use App\Models\BrandsModels;
use Illuminate\Support\Facades\App;
use App\Models\City;
use App\Services\IpgHashService;
use App\Models\PaymentInfo;
use Illuminate\Pagination\LengthAwarePaginator;

class AdsController extends Controller
{


    public function browseAds(Request $request)
{
    $locale = App::getLocale();
    $searchName = 'name_' . $locale;

    $selectedLocation = $request->input('location');
    $selectedCity = $request->input('city');
    $selectedCategory = $request->input('category');
    $selectedSubCategory = $request->input('subcategory');
    $searchTerm = $request->input('search-field');

    $selectedCityName = 'Locations';
    $selectedCategoryName = 'Categories';
    if (isset($selectedCity)) {
        $cityModel = City::find($selectedCity);
        $selectedCityName = $cityModel ? $cityModel->$searchName : 'Locations';
    }
    if (isset($selectedCategory)) {
        $categoryModel = Category::where('mainId', $selectedCategory)->first();
        $selectedCategoryName = $categoryModel ? $categoryModel->name : 'Categories';
    }

    $categories = Category::where('mainId', 0)->get();
    $districts = Districts::all();
    $citys = Cities::all();

    // Super Ads
    $superAds = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
        ->where('ads_package', 6)
        ->where('status', 1)
        ->when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('cat_id', $selectedCategory);
        })
        ->where(function ($query) {
            $query->whereNull('package_expire_at')
                  ->orWhere('package_expire_at', '>=', now());
        })
        ->latest()
        ->get();

    // Non-package-4 ads
    $nonPackage4Ads = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
        ->where('status', 1)
        ->where('ads_package', '!=', 4)
        ->when($selectedLocation, function ($query) use ($selectedLocation, $selectedCity) {
            $query->where(function ($q) use ($selectedLocation, $selectedCity) {
                $q->where('location', $selectedLocation)->orWhere('sublocation', $selectedCity);
            });
        })
        ->when($selectedCategory, function ($query) use ($selectedCategory) {
            $query->where('cat_id', $selectedCategory);
        })
        ->when($selectedSubCategory, function ($query) use ($selectedSubCategory) {
            $query->where('sub_cat_id', $selectedSubCategory);
        })
        ->when($searchTerm, function ($query) use ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        })
        ->orderByRaw("CASE
            WHEN ads_package = 3 THEN 1
            WHEN ads_package = 6 THEN 2
            WHEN ads_package = 5 THEN 2
            ELSE 4
        END")
        ->latest()
        ->get();

    // Package 4 ads
    $package4Ads = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
        ->where('status', 1)
        ->where('ads_package', 4)
        ->when($selectedLocation, function ($query) use ($selectedLocation, $selectedCity) {
            $query->where(function ($q) use ($selectedLocation, $selectedCity) {
                $q->where('location', $selectedLocation)->orWhere('sublocation', $selectedCity);
            });
        })
        ->when($selectedCategory, function ($query) use ($selectedCategory) {
            $query->where('cat_id', $selectedCategory);
        })
        ->when($selectedSubCategory, function ($query) use ($selectedSubCategory) {
            $query->where('sub_cat_id', $selectedSubCategory);
        })
        ->when($searchTerm, function ($query) use ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        })
        ->latest()
        ->get();

    $rotated = collect();
    $package4Count = $package4Ads->count();
    if ($package4Count > 0) {
        $time = now();
        $slot = floor($time->diffInSeconds(now()->startOfDay()) / 30);
        $index = $slot % $package4Count;
        $rotated = $package4Ads->slice($index)->concat($package4Ads->slice(0, $index));
    }

    $allSortedAds = $nonPackage4Ads->concat($rotated);

    // Manual pagination
    $page = request()->get('page', 1);
    $perPage = 30;
    $paginatedItems = $allSortedAds->forPage($page, $perPage);

    $ads = new LengthAwarePaginator(
        $paginatedItems,
        $allSortedAds->count(),
        $perPage,
        $page,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    $category = Category::find($selectedCategory);
    $banners = Banners::where('type', 1)->get();
    $all_banners = Banners::where('type', 0)->get();

    return view('newFrontend.browse-ads', compact(
        'categories', 'superAds', 'all_banners', 'ads', 'districts', 'banners',
        'category', 'citys', 'selectedCityName', 'selectedCategoryName'
    ));
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
        $invoiceId = "YKAD".date('YmsHsi');
        
        session(['invoiceId' => $invoiceId]);

        $mainImage = $ad->mainImage;

        

        return view('newFrontend.ads_boost_plans', compact('ad', 'mainImage', 'packages', 'packageTypes','invoiceId'));
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
                    ->orWhere('description', 'like', "%$query%");
            })
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orWhereHas('subcategory', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->get();

        return view('newFrontend.search-results', compact('ads')); // Adjust the view path if necessary
    }




}
