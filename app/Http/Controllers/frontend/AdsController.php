<?php

namespace App\Http\Controllers\frontend;

use App\Models\Ads;
use App\Models\Category;
use App\Models\Cities;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdsController extends Controller
{
  

    public function browseAds()
    {
        $categories = Category::where('mainId', 0)->get();
        $cities = Cities::all();
        // Get ads with necessary data
        $ads = Ads::with(['main_location', 'sub_location', 'category', 'subcategory'])
            ->latest()
            ->paginate(15);
    
        return view('newFrontend.browse-ads', compact('categories', 'ads','cities'));
    }
}
