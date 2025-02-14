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
        $categories = Category::where('mainId', 0)
            ->where('status', 1)
            ->withCount(['ads' => function ($query) {
                $query->where('status', 1);
            }])
            ->get();

            $banners = \App\Models\Banners::where('type', 0)->get();

            $topbanners = \App\Models\Banners::where('type', 1)->get();
            $superbanners = \App\Models\Banners::where('type', 6)->get();

            
            $superAds = Ads::with(['category', 'subcategory'])
            ->where('ads_package', 6)  // Filter only top ads
            ->latest()
            ->take(5)  // Show 5 ads in the slideshow
            ->get();

            $topAds = Ads::with(['category', 'subcategory'])
            ->where('ads_package', 3)  // Filter only top ads
            ->latest()
            ->take(5)  // Show 5 ads in the slideshow
            ->get();

            $latestAds = Ads::latest()
            ->where('ads_package', 4)
            ->take(6)
            ->get();
    
            $superAds = Ads::with(['category', 'subcategory'])
            ->where('ads_package', 4) 
            ->latest()
            ->take(5)  // Limit the number of Super Ads
            ->get();
        return view('newFrontend.index', compact('banners', 'categories', 'topAds','topbanners','latestAds','superbanners','superAds'));
    }

    public function index(){

    }

  
    public function aboutUs()
    {
        return view('newFrontend.about-us');
    }
    public function contactUs()
    {
        return view('newFrontend.contact-us');
    }

    public function privacySafety()
    {
        return view('newFrontend.privacy-safety');
    }
    public function termsConditions()
    {
        return view('newFrontend.terms-conditions');
    }



    public function tips()
    {
        return view('newFrontend.tips');
    }
    public function boosting_ads()
    {
        return view('newFrontend.boosting_ads');
    }
    public function add_posting()
    {
        return view('newFrontend.add_posting');
    }
    public function add_post()
    {
        return view('newFrontend.add_post');
    }
    
   
 
      
       
}
