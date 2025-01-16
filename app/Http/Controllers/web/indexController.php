<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Category;
use App\Models\Districts;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class indexController extends Controller
{
    public function index(Request $request)
    {
        // Set the locale based on the request or default to 'en'
        $locale = $request->get('lang', 'en');
        app()->setLocale($locale);
        session()->put('locale', $locale);

        // Fetch required data
        $categories = Category::where('mainId', 0)
            ->where('status', 1)
            ->get();

        $package = Package::with('packageTypes')
            ->where('status', 1)
            ->get();

        $topcategories = Category::with('subcat')
            ->where('mainId', 0)
            ->where('status', 1)
            ->paginate(8);

        $adsWithRelations = ['main_location', 'sub_location', 'category', 'subcategory'];

        $recommendAds = Ads::with($adsWithRelations)
            ->where('ads_package', 5)
            ->where('status', 1)
            ->paginate(5);

        $popular = Ads::with($adsWithRelations)
            ->where('status', 1)
            ->paginate(5);

        $topAds = Ads::with($adsWithRelations)
            ->where('ads_package', 3)
            ->where('status', 1)
            ->get();

        $superAds = Ads::with($adsWithRelations)
            ->where('ads_package', 6)
            ->where('status', 1)
            ->get();

        $districts = Districts::paginate(6);

        // Return view with compacted data
        return view('web.index', compact(
            'categories',
            'package',
            'topcategories',
            'recommendAds',
            'popular',
            'topAds',
            'superAds',
            'districts'
        ));
    }

}
