<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banners;
use App\Models\Ads;

class HomeController extends Controller
{

    public function home()
    {
        $categories = Category::where('mainId',0 )
            ->where('status', 1)
            ->withCount(['ads' => function ($query) {
                $query->where('status', 1);
            }])

            ->get();

        $banners = \App\Models\Banners::where('type', 0)->get();

        $topbanners = \App\Models\Banners::where('type', 1)->get();
        $superbanners = \App\Models\Banners::where('type', 1)->get();

        // Get Super Ads that are active and not expired
        $superAds = Ads::with(['category', 'subcategory'])
            ->where('ads_package', 6)
            ->where('status', 1)
            ->where(function($query) {
                $query->whereNull('package_expire_at')
                      ->orWhere('package_expire_at', '>=', now());
            })
            ->latest()
            ->take(5)
            ->get();

        // Get Top Ads that are active and not expired
        $topAds = Ads::with(['category', 'subcategory'])
            ->where('ads_package', 3)
            ->where('status', 1)
            ->where(function($query) {
                $query->whereNull('package_expire_at')
                      ->orWhere('package_expire_at', '>=', now());
            })
            ->latest()
            ->take(5)
            ->get();

        // Get Latest Ads that are active and not expired
        $latestAds = Ads::latest()
            ->where('ads_package', 4)
            ->where('status', 1)
            ->where(function($query) {
                $query->whereNull('package_expire_at')
                      ->orWhere('package_expire_at', '>=', now());
            })
            ->take(6)
            ->get();

        // Get Super Ads again but make sure they are not expired and active
        $superAds = Ads::with(['category', 'subcategory'])
            ->where('ads_package', 6)
            ->where('status', 1)
            ->where(function($query) {
                $query->whereNull('package_expire_at')
                      ->orWhere('package_expire_at', '>=', now());
            })
            ->latest()
            ->take(5)
            ->get();

        return view('newFrontend.index', compact('banners', 'categories', 'topAds', 'topbanners', 'latestAds', 'superbanners', 'superAds'));
    }


    public function index(){

    }


    public function aboutUs()
    {
        $banners = \App\Models\Banners::where('type', 0)->get();

        $topbanners = \App\Models\Banners::where('type', 1)->get();
        $superbanners = \App\Models\Banners::where('type', 1)->get();
        return view('newFrontend.about-us',compact('banners'));


    }
    public function contactUs()
    {
        return view('newFrontend.contact-us');
    }

    public function privacySafety()
    {
        $banners = \App\Models\Banners::where('type', 0)->get();

        $topbanners = \App\Models\Banners::where('type', 1)->get();
        $superbanners = \App\Models\Banners::where('type', 1)->get();
        return view('newFrontend.privacy-safety',compact('banners'));
    }
    public function termsConditions()
    {
        $banners = \App\Models\Banners::where('type', 0)->get();

        $topbanners = \App\Models\Banners::where('type', 1)->get();
        $superbanners = \App\Models\Banners::where('type', 1)->get();

        return view('newFrontend.terms-conditions',compact('banners'));
    }



    public function tips()
    {
        $banners = \App\Models\Banners::where('type', 0)->get();

        $topbanners = \App\Models\Banners::where('type', 1)->get();
        $superbanners = \App\Models\Banners::where('type', 1)->get();
        return view('newFrontend.tips',compact('banners'));
    }
    public function boosting_ads()
    {
        $banners = \App\Models\Banners::where('type', 0)->get();

        $topbanners = \App\Models\Banners::where('type', 1)->get();
        $superbanners = \App\Models\Banners::where('type', 1)->get();
        return view('newFrontend.boosting_ads',compact('banners'));
    }
    public function add_posting()
    {
        $banners = \App\Models\Banners::where('type', 0)->get();

        $topbanners = \App\Models\Banners::where('type', 1)->get();
        $superbanners = \App\Models\Banners::where('type', 1)->get();
        return view('newFrontend.add_posting',compact('banners'));
    }
    public function add_post()
    {
        $banners = \App\Models\Banners::where('type', 0)->get();

        $topbanners = \App\Models\Banners::where('type', 1)->get();
        $superbanners = \App\Models\Banners::where('type', 1)->get();
        return view('newFrontend.add_post',compact('banners'));
    }





}
