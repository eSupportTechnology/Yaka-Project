<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\BrandsModels;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandsModelsController extends Controller
{
    public function GetBrands($category)
    {
        $mainid = Category::where('id', $category)->select('mainId')->firstOrFail();

        if($mainid->mainId){
           $brands = BrandsModels::where('sub_cat_id',$category)->get();

            return response()->json([
                'status'=>true,
                'data'=>$brands
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message' => 'Only sub categories have brands!',
            ],500);
        }
    }


    public function GetModels($brands)
    {

        $isbrand = BrandsModels::where('id', $brands)->select('brandsId')->firstOrFail();

       if($isbrand->brandsId == 0){
           $models = BrandsModels::where('brandsId',$brands)->get();

           return response()->json([
               'status'=>true,
               'data'=>$models
           ],200);

       }else{
           return response()->json([
               'status'=>false,
               'message' => 'Is not Brand!',
           ],500);
       }
    }
}
