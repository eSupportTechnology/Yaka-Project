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
