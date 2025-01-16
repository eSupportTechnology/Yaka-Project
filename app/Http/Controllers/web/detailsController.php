<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\AdsTypes;
use App\Models\BrandsModels;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class detailsController extends Controller
{
    public function index($id)
    { app()->setlocale(Session::get('locale'));
        $ad = Ads::find($id);
        $ad->view_counr = $ad->view_counr+1;
        $ad->save();

        $caturl = Category::find($ad->cat_id);

        $data = Ads::with('ads_'.preg_replace('/-/', '', $caturl->url),'user', 'main_location', 'sub_location', 'category', 'subcategory')->find($id);
        $brands = BrandsModels::where('status',1)->where('brandsId',0)->where('sub_cat_id',$ad->sub_cat_id)->pluck('name', 'id')->toArray();
        $model = BrandsModels::where('status',1)->where('brandsId','!=',0)->pluck('name', 'id')->toArray();
        $type =  AdsTypes::where('status',1)->pluck('name', 'id')->toArray();


        return view('web.ads-details',['adsurl'=>$caturl->url, 'data'=>$data ,'brands'=>$brands ,'model'=>$model ,'type'=>$type]);
    }
}
