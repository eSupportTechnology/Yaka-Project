<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Provinces;
use Illuminate\Http\Request;

class LocattionController extends Controller
{
    public function GetProvince()
    {
        $province = Provinces::get();

        return response()->json([
            'status'=>true,
            'provinces'=>$province
        ],200);
    }


    // public function GetDistrict($province)
    // {
    //     $isProvince = Provinces::where('id', $province)->exists();

    //     if(!$isProvince){
    //         $district = Districts::where('province_id',$province)->get();

    //         return response()->json([
    //             'status'=>true,
    //             'district'=>$district
    //         ],200);
    //     }else{
    //         return response()->json([
    //             'status'=>false,
    //             'message' => 'Provinces is not found',
    //         ],500);
    //     }
    // }
    
    public function GetDistrict()
    {
            $districts = Districts::get();
            $result = [];
            foreach ($districts as $dis) {
                $cities = Cities::where('district_id', $dis->id)->get();
                $result[] = [
                    'district' => $dis,
                    'cities' => $cities
                ];
            }

            return response()->json([
                'status' => true,
                'data' => $result
            ], 200);
            
    }
    

    public function GetCity($district)
    {
        $isDistricts = Districts::where('id', $district)->exists();

        if($isDistricts){
            $city = Cities::where('district_id',$district)->get();

            return response()->json([
                'status'=>true,
                'cities'=>$city
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message' => 'Districts is not found',
            ],500);
        }
    }
}
