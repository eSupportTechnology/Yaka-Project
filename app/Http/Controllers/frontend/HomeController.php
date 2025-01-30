<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banners;

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
        
        return view('newFrontend.index', compact('banners','categories'));
    }

}
