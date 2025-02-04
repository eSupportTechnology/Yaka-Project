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
        return view('newFrontend.index');
    }

    public function index()
    {
        $banners = Banners::all(); 

        $categories = Category::all();

        $topAds = Ads::with(['category', 'subcategory'])
        ->where('ads_package', 3)  // Filter only top ads
        ->latest()
        ->take(5)  // Show 5 ads in the slideshow
        ->get();

    return view('newFrontend.index', compact('banners', 'categories', 'topAds'));
}
}
