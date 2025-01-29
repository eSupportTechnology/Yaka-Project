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
}
