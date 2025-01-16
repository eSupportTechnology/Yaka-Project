<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;


class HomeController extends Controller
{
    public function aboutUs()
{
    // Locale set 
    app()->setlocale(Session::get('locale'));
    $locale = app()->getLocale();

    // Translate data
    $data = [
        'title' => GoogleTranslate::trans('About Us', $locale),
        'content' => [
            GoogleTranslate::trans('Yaka.lk is the largest growing market place in Sri Lanka. This is a 100 % Sri Lankan website which designed specially to suit Sri Lankans. If you want to buy or sell anything, you have arrived to the right destination.', $locale),
            GoogleTranslate::trans('Yaka.lk has the broad selection of items so you can navigate through many categories such as Electronics, Vehicles, Property, jobs, Industrial, etc., also you can use search filters in order to make it quick in findings.', $locale),
            GoogleTranslate::trans('You can create free account in yaka.lk and post your advertisement within no time and as soon as you publish, we will review it and allow to view in website. Also, you can choose add promotion packages for better results.', $locale),
        ]
    ];

    // pass the data in the view
    return view('web.about', compact('data'));
}

    public function contactUs()
    {
        // Locale set 
        app()->setLocale(Session::get('locale', 'en')); //set  Default locale 'en' 
        $locale = app()->getLocale();
    
        // View  return 
        return view('web.contact', compact('locale'));
    }

    public function privacySafety()
    {
        // Current locale
        $locale = app()->getLocale();
        
        // Initialize GoogleTranslate
        $translator = new GoogleTranslate($locale);

        // Strings to be translated
        $translations = [
            'Privacy Policy' => $translator->translate('Privacy Policy'),
            'Information We Collect' => $translator->translate('Information We Collect'),
            'Personal Data' => $translator->translate('Personal Data'),
            'Usage Data' => $translator->translate('Usage Data'),
            'Cookies' => $translator->translate('Cookies'),
            'How We Use Your Data' => $translator->translate('How We Use Your Data'),
            'Data Sharing and Disclosure' => $translator->translate('Data Sharing and Disclosure'),
            'Data Security' => $translator->translate('Data Security'),
            'User Rights' => $translator->translate('User Rights'),
            'Cookies Policy' => $translator->translate('Cookies Policy'),
            'Third-Party Services' => $translator->translate('Third-Party Services'),
            'Data Retention' => $translator->translate('Data Retention'),
            "Children's Privacy" => $translator->translate("Children's Privacy"),
            'Changes to the Privacy Policy' => $translator->translate('Changes to the Privacy Policy'),
        ];

        return view('web.privacy-safety', compact('translations'));
    }
    public function careers()
    {
        return view('web.careers');
    } 
    public function temsConditions()
    {
        {
            // Google Translate Object
            $GoogleTranslate = new GoogleTranslate();
        
            // Translate 
            $translatedText = $GoogleTranslate->setTarget('si')->translate('Terms & Conditions');
        
            return view('web.tems-conditions', compact('translatedText'));
        }
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
