<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\AdsPosttController;
use App\Http\Controllers\web\filtersController;
use App\Http\Requests\api\FilterRequest;
use App\Models\Ads;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class AdsController extends Controller
{
    public function index($category,$district = 0)
    {
        $mainid = Category::where('id', $category)->select('mainId')->firstOrFail();


        if($mainid->mainId){
            //sub category
            $getcategory = Category::where('id', $mainid->mainId)->select('url')->firstOrFail();
            $adsurl = preg_replace('/-/', '', $getcategory->url);
            $adsQ = Ads::with('ads_'.$adsurl, 'main_location', 'sub_location', 'category', 'subcategory')
            ->where('sub_cat_id', $category);
        }else{
            $getcategory = Category::where('id', $category)->select('url')->firstOrFail();
            $adsurl = preg_replace('/-/', '', $getcategory->url);
            $adsQ = Ads::with('ads_'.$adsurl, 'main_location', 'sub_location', 'category', 'subcategory')
            ->where('cat_id', $category);
        }

        if($district){
            $adsQ->where('location', $district);
        }


        $ads = $adsQ->orderBy('bump_up_at', 'DESC')->where('status', 1)->get();


        return response()->json([
            'status'=>true,
            'data'=>$ads
        ],200);

    }

      public function AllAds($paginate){
        $adsQ = Ads::with( 'main_location', 'sub_location', 'category', 'subcategory')->orderBy('bump_up_at', 'DESC')->where('status', 1)->paginate($paginate);

        return response()->json([
            'status'=>true,
            'data'=>$adsQ
        ],200);

    }

    public function filter(FilterRequest $request )
    {
        $mainid = Category::where('id', $request->category)->select('mainId','id')->firstOrFail();

        if($mainid->mainId){
            //sub category
            $getcategory = Category::where('id', $mainid->mainId)->select('url')->firstOrFail();
            $adsurl = preg_replace('/-/', '', $getcategory->url);
            $adsQ = Ads::with('ads_'.$adsurl, 'main_location', 'sub_location', 'category', 'subcategory')
                ->where('sub_cat_id', $request->category);
        }else{
            $getcategory = Category::where('id', $request->category)->select('url')->firstOrFail();
            $adsurl = preg_replace('/-/', '', $getcategory->url);
            $adsQ = Ads::with('ads_'.$adsurl, 'main_location', 'sub_location', 'category', 'subcategory')
                ->where('cat_id', $request->category);
        }


        $this->commonFilter($request, $adsQ, $adsurl);
        $url = str_replace('-', '', $getcategory->url);
        $filtersController = new filtersController();
        $methodName = $url;
        $filtersController->$methodName($request, $adsQ, $adsurl);


        $ads = $adsQ->orderBy('bump_up_at', 'DESC')->where('status', 1)->get();

        return response()->json([
            'status' => false,
            'data' => $ads,
        ], 500);
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
