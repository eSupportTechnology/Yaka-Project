<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\AdsTypes;
use App\Models\BrandsModels;
use App\Models\Category;
use App\Models\Districts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class adsDisplayController extends Controller
{
    public function index(Request $request, $category , $location = 0 )
    {
        app()->setlocale(Session::get('locale'));
//        return $request;
        $mainid = Category::where('url', $category)->select('mainId','id')->firstOrFail();

        $nowSearchSubCategoryUrl=0;
        $nowSearchLocation = 0;
        $brands=0;

        if($mainid->mainId){
            $getcategory = Category::where('id', $mainid->mainId)->select('url','id')->firstOrFail();
            $category_url = $getcategory->url;
            $nowSearchSubCategoryUrl = $category;
            $adsurl = preg_replace('/-/', '', $getcategory->url);


            $brands = BrandsModels::where('brandsId', '0')->where('sub_cat_id', $mainid->id)->get();

        }else{
             $category_url =$category;
            $adsurl = preg_replace('/-/', '', $category);
        }


        $category = Category::where('url', $category_url)->firstOrFail();
        $subCategory = ($nowSearchSubCategoryUrl != 0) ? Category::where('url', $nowSearchSubCategoryUrl)->first() : null;

        $categories = Category::where('mainId', 0)->where('status', 1)->get();
        $subCategories = Category::where('mainId', $category->id)->where('status', 1)->get();
        $locations = Districts::get();

        $topAdsData =  Ads::with('ads_'.$adsurl, 'main_location', 'sub_location', 'category', 'subcategory')
            ->where('cat_id', $category->id)
            ->where('ads_package', 3)
            ->where('status', 1)->get();

        $Urgent =  Ads::with('ads_'.$adsurl, 'main_location', 'sub_location', 'category', 'subcategory')
            ->where('cat_id', $category->id)
            ->where('ads_package', 4)
            ->where('status', 1)->get();

        $adsQuery = Ads::with('ads_'.$adsurl, 'main_location', 'sub_location', 'category', 'subcategory')
            ->where('cat_id', $category->id)
            ->whereNotIn('ads_package',[3,4])
            ->orderBy('bump_up_at', 'DESC')
            ->where('status', 1);

        if(isset($request->_token)){
            $this->commonFilter($request, $adsQuery,$adsurl);
            $url = preg_replace('/-/', '', $category_url);
            (new filtersController())->{$url}($request, $adsQuery,$adsurl);
        }

        $typs = AdsTypes::where('status' , '1')->where('catergoryId' , $mainid->id)->get();
        if ($subCategory) {
            $adsQuery->where('sub_cat_id', $subCategory->id);
        }
        if ($location) {
            $locationid = Districts::where('url', $location)->select('id')->firstOrFail();
            $adsQuery->where('location', $locationid->id);
            $nowSearchLocation = $location;
        }

        $adsData = $adsQuery->paginate(9);

        // dd($adsData);

        return view('web.ads', compact('adsurl','typs','brands','categories','nowSearchSubCategoryUrl','nowSearchLocation','subCategory', 'subCategories', 'locations', 'category', 'adsData', 'topAdsData','Urgent'));
    }

















    public function commonFilter($request, $mainquery,$adsurl)
    {
//            filter_price_types
        if ($request->has('price_types') && !empty($request->price_types)) {
            $mainquery->whereIn('price_type', $request->price_types);
            \Illuminate\Support\Facades\Session::put('filter_price_types' , $request->price_types);
        }else{
            Session::put('filter_price_types' , []);
        }

//            filter_post_types
        if ($request->has('post_types') && !empty($request->post_types)) {
            $mainquery->whereIn('post_type', $request->post_types);
            Session::put('filter_post_types' , $request->post_types);
        }else{
            Session::put('filter_post_types' , []);
        }
//            filter_minprice
        if ($request->minprice > 0) {

            $mainquery->where('price', '>=', $request->minprice);
            session(['filter_minprice' => $request->minprice]);
        }else{
            session(['filter_minprice' => 0]);
        }

//            filter_maxprice
        if ($request->maxprice > 0) {
            $mainquery->where('price', '<=', $request->maxprice);
            session(['filter_maxprice' => $request->maxprice]);
        }else{
            session(['filter_maxprice' => 0]);
        }

        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
//            filter_condition
            if ($request->has('condition') && !empty($request->condition)) {
                $query->whereIn('condition', $request->condition);
                Session::put('filter_condition' , $request->condition);
            }else{
                Session::put('filter_condition' , []);
            }

//            filter_brand
            if ($request->has('brand') && !empty($request->brand)) {
                $query->whereIn('brand', $request->brand);
                Session::put('filter_brand' , $request->brand);
            }else{
                Session::put('filter_brand' , []);
            }


        });

    }


}
