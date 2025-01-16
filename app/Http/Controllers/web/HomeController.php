<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function aboutUs()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.about');
    }

    public function contactUs()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.contact');
    }

    public function privacySafety()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.privacy-safety');
    }
    public function careers()
    {
        return view('web.careers');
    } 
    public function temsConditions()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.tems-conditions');
    }
    public function faq()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.faq');
    }

    public function Tips()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.tips');
    }
    public function BoostingAds()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.boosting-ads');
    }

    public function AdpostingAllowances()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.ads-posting-allowances');
    }

    public function Adpostingcriteria()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.ad-posting-criteria');
    }
    
    public function BannerAds()
    {
        app()->setlocale(Session::get('locale'));
        return view('web.banner-ads');
    }
}
