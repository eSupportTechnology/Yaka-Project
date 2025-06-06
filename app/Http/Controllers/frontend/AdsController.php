<?php

namespace App\Http\Controllers\frontend;

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
use Illuminate\Http\Request;
use App\Services\IpgHashService;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class AdsController extends Controller
{


    public function browseAds(Request $request)
    {
        $locale = App::getLocale();
        $searchName = 'name_'.$locale;
        // Get selected filters from the request
        $selectedLocation = $request->input('location');
        $selectedCity = $request->input('city');
        $selectedCategory = $request->input('category');
        $selectedSubCategory = $request->input('subcategory');
        $searchTerm = $request->input('search-field');

        $selectedCityName = 'Locations';
        $selectedCategoryName = 'Categories';
        if(isset($selectedCity)) {
            $selectedCityName = City::where('id', $selectedCity)->first()->$searchName;
        }
        if(isset($selectedCategory)) {
            $selectedCategoryName = Category::where('mainId', $selectedCategory)->first()->name;
        }

        $categories = Category::where('mainId', 0)->get();
        $districts = Districts::all();
        $citys = Cities::all();

        // Fetch urgent ads based on the selected category and package expiry date check
        $superAdsQuery = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->where('ads_package', 6)
            ->where('status', 1)
            ->where(function($query) {
                $query->whereNull('package_expire_at')
                      ->orWhere('package_expire_at', '>=', now());
            })
            ->latest();

        if (!empty($selectedCategory)) {
            $superAdsQuery->where('cat_id', $selectedCategory);
        }

        $superAds = $superAdsQuery->get();

        $baseQuery = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->where('status', 1)
            ->where(function ($query) {
                $query->whereNull('package_expire_at')
                    ->orWhere('package_expire_at', '>=', Carbon::now());
            });

        // Apply filters dynamically
        $applyFilters = function ($query) use ($selectedLocation, $selectedCity, $selectedCategory, $selectedSubCategory, $searchTerm) {
            if (!empty($selectedLocation)) {
                $query->where(function ($q) use ($selectedLocation, $selectedCity) {
                    $q->where('location', $selectedLocation)
                    ->orWhere('sublocation', $selectedCity);
                });
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
                ->orderBy('updated_at', 'desc')
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

        $all_banners = \App\Models\Banners::where('type', 0)->get();

        return view('newFrontend.browse-ads', compact('categories', 'superAds','all_banners', 'ads', 'districts', 'banners', 'category','citys', 'selectedCityName', 'selectedCategoryName'));
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
