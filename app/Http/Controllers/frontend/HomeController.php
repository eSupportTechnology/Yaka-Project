<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

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

        return view('newFrontend.index', compact('categories'));
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
}
