<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('newFrontend.index');
    }
    public function aboutUs()
    {
        return view('newFrontend.about-us');
    }
    public function contactUs()
    {
        return view('newFrontend.contact-us');
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
