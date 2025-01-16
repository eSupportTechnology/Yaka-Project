<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class filtersController extends Controller
{

    public function otherads($request, $mainquery,$adsurl)
    {
    }

    public function property($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {

            if ($request->size_of_land_min > 0) {
                $query->where('size_of_land', '>=', $request->size_of_land_min);
                session(['filter_size_of_land_min' => $request->size_of_land_min]);
            }else{
                session(['filter_size_of_land_min' => 0]);
            }

            if ($request->size_of_land_max > 0) {
                $query->where('size_of_land', '<=', $request->size_of_land_max);
                session(['filter_size_of_land_max' => $request->size_of_land_max]);
            }else{
                session(['filter_size_of_land_max' => 0]);
            }

            if ($request->size_sf_min > 0) {
                $query->where('size_sf', '>=', $request->size_sf_min);
                session(['filter_size_of_land_min' => $request->size_sf_min]);
            }else{
                session(['filter_size_sf_min' => 0]);
            }

            if ($request->size_sf_max > 0) {
                $query->where('size_sf', '<=', $request->size_sf_max);
                session(['filter_size_sf_max' => $request->size_sf_max]);
            }else{
                session(['filter_size_sf_max' => 0]);
            }

            if ($request->has('unit') && !empty($request->unit)) {
                $query->whereIn('unit', $request->unit);
                Session::put('filter_unit' , $request->unit);
            }else{
                Session::put('filter_unit' , []);
            }

            if ($request->has('bathrooms') && !empty($request->bathrooms)) {
                $query->whereIn('bathrooms', $request->bathrooms);
                Session::put('filter_bathrooms' , $request->bathrooms);
            }else{
                Session::put('filter_bathrooms' , []);
            }

            if ($request->has('rooms') && !empty($request->rooms)) {
                $query->whereIn('rooms', $request->rooms);
                Session::put('filter_rooms' , $request->rooms);
            }else{
                Session::put('filter_rooms' , []);
            }

            if ($request->has('type') && !empty($request->type)) {
                $query->whereIn('type', $request->type);
                Session::put('filter_type' , $request->type);
            }else{
                Session::put('filter_type' , []);
            }
        });
    }
   public function electronics($request, $mainquery,$adsurl)
   { app()->setlocale(Session::get('locale'));
       $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {

           if ($request->has('specialization') && is_array($request->specialization) && !empty($request->specialization)) {
               foreach ($request->specialization as $specialization) {
                   $query->where('specialization', 'like', '%' . $specialization . '%');
               }
               Session::put('filter_specialization', $request->specialization);
           } else {
               Session::put('filter_specialization', []);
           }

           if ($request->has('screen_size') && !empty($request->screen_size)) {
               $query->whereIn('screen_size', $request->screen_size);
               session(['filter_screen_size' => $request->screen_size]);
           }else {
               Session::put('filter_screen_size', []);
           }

           if ($request->has('type') && !empty($request->type)) {
               $query->whereIn('type', $request->type);
               Session::put('filter_type' , $request->type);
           }else{
               Session::put('filter_type' , []);
           }

           if ($request->has('capacity') && !empty($request->capacity)) {
               $query->whereIn('capacity', $request->capacity);
               Session::put('filter_capacity' , $request->capacity);
           }else{
               Session::put('filter_capacity' , []);
           }

       });
   }
    public function vehicles($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {


            if ($request->manufacture_year_min > 0) {
                $query->where('manufacture_year', '>=', $request->manufacture_year_min);
                session(['filter_manufacture_year_min' => $request->manufacture_year_min]);
            }else{
                session(['filter_manufacture_year_min' => 0]);
            }


            if ($request->manufacture_year_max > 0) {
                $query->where('manufacture_year', '<=', $request->manufacture_year_max);
                session(['filter_manufacture_year_max' => $request->manufacture_year_max]);
            }else{
                session(['filter_manufacture_year_max' => 0]);
            }

            if ($request->has('engine_capacity') && !empty($request->engine_capacity)) {
                $query->where('engine_capacity', $request->engine_capacity);
                session(['filter_engine_capacity' => $request->engine_capacity]);
            }else{
                Session::put('filter_engine_capacity' ,  '');
            }

            if ($request->has('gears_up') && !empty($request->gears_up)) {
                $query->where('gears_up', $request->gears_up);
                session(['filter_gears_up' => $request->gears_up]);
            }else{
                Session::put('filter_gears_up' , '');
            }

            if ($request->has('fragment_type') && !empty($request->fragment_type)) {
                $query->where('fragment_type', $request->fragment_type);
                session(['filter_fragment_type' => $request->fragment_type]);
            }else{
                Session::put('filter_fragment_type' ,  '');
            }

            if ($request->has('Mileage') && !empty($request->Mileage)) {
                $query->where('Mileage', $request->Mileage);
                session(['filter_Mileage' => $request->Mileage]);
            }else{
                Session::put('filter_Mileage' ,  '');
            }

            if ($request->has('edition') && !empty($request->edition)) {
                $query->where('edition', $request->edition);
                session(['filter_edition' => $request->edition]);
            }else{
                Session::put('filter_edition' ,  '');
            }

            if ($request->has('model_year') && !empty($request->model_year)) {
                $query->where('model_year', $request->model_year);
                session(['filter_model_year' => $request->model_year]);
            }else{
                Session::put('filter_model_year' ,  '');
            }

            if ($request->has('fuel_Type') && !empty($request->fuel_Type)) {
                $query->whereIn('fuel_Type', $request->fuel_Type);
                Session::put('filter_fuel_Type' , $request->fuel_Type);
            }else{
                Session::put('filter_fuel_Type' , []);
            }

            if ($request->has('body_type') && !empty($request->body_type)) {
                $query->whereIn('type', $request->body_type);
                Session::put('filter_body_type' , $request->body_type);
            }else{
                Session::put('filter_body_type' , []);
            }

            if ($request->has('service_type') && !empty($request->service_type)) {
                $query->whereIn('type', $request->service_type);
                Session::put('filter_service_type' , $request->service_type);
            }else{
                Session::put('filter_service_type' , []);
            }

            if ($request->has('transmission') && !empty($request->transmission)) {
                $query->whereIn('transmission', $request->transmission);
                Session::put('filter_transmission' , $request->transmission);
            }else{
                Session::put('filter_transmission' , []);
            }

        });

    }
    public function animals($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('type') && !empty($request->type)) {
                $query->whereIn('type', $request->type);
                Session::put('filter_type' , $request->type);
            }else{
                Session::put('filter_type' , []);
            }
        });
    }
    public function jobs($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {

            if ($request->has('job_type') && is_array($request->job_type) && !empty($request->job_type)) {
                foreach ($request->job_type as $job_type) {
                    $query->where('job_type', 'like', '%' . $job_type . '%');
                }
                Session::put('filter_job_type', $request->job_type);
            } else {
                Session::put('filter_job_type', []);
            }


            if ($request->has('education') && is_array($request->education) && !empty($request->education)) {
                foreach ($request->education as $education) {
                    $query->where('education', 'like', '%' . $education . '%');
                }
                Session::put('filter_education', $request->education);
            } else {
                Session::put('filter_education', []);
            }


            if ($request->minsalary_per_month > 0) {
                $query->where('salary_per_month', '>=', $request->minsalary_per_month);
                session(['filter_minsalary_per_month' => $request->minsalary_per_month]);
            }else{
                session(['filter_minsalary_per_month' => 0]);
            }


            if ($request->maxsalary_per_month > 0) {
                $query->where('salary_per_month', '<=', $request->maxsalary_per_month);
                session(['filter_maxsalary_per_month' => $request->maxsalary_per_month]);
            }else{
                session(['filter_maxsalary_per_month' => 0]);
            }



        });
    }

    public function homegarden($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('type') && !empty($request->type)) {
                $query->whereIn('type', $request->type);
                Session::put('filter_type' , $request->type);
            }else{
                Session::put('filter_type' , []);
            }
        });
    }

    public function services($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('type') && !empty($request->type)) {
                $query->whereIn('type', $request->type);
                Session::put('filter_type' , $request->type);
            }else{
                Session::put('filter_type' , []);
            }
        });
    }

    public function businessandindustry($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('type') && !empty($request->type)) {
                $query->whereIn('type', $request->type);
                Session::put('filter_type' , $request->type);
            }else{
                Session::put('filter_type' , []);
            }
        });
    }

    public function hobbysportsandkids($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('type') && !empty($request->type)) {
                $query->whereIn('type', $request->type);
                Session::put('filter_type' , $request->type);
            }else{
                Session::put('filter_type' , []);
            }
        });

        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('gender') && !empty($request->gender)) {
                $query->whereIn('gender', $request->gender);
                Session::put('filter_gender' , $request->gender);
            }else{
                Session::put('filter_gender' , []);
            }
        });
    }

    public function fashionandbeauty($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('type') && !empty($request->type)) {
                $query->whereIn('type', $request->type);
                Session::put('filter_type' , $request->type);
            }else{
                Session::put('filter_type' , []);
            }
        });

        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('gender') && !empty($request->gender)) {
                $query->whereIn('gender', $request->gender);
                Session::put('filter_gender' , $request->gender);
            }else{
                Session::put('filter_gender' , []);
            }
        });
    }

    public function essentials($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('type') && !empty($request->type)) {
                $query->whereIn('type', $request->type);
                Session::put('filter_type' , $request->type);
            }else{
                Session::put('filter_type' , []);
            }
        });
    }

    public function education($request, $mainquery,$adsurl)
    { app()->setlocale(Session::get('locale'));
        $mainquery->whereHas('ads_'.$adsurl, function ($query) use ($request) {
            if ($request->has('type') && !empty($request->type)) {
                $query->whereIn('type', $request->type);
                Session::put('filter_type' , $request->type);
            }else{
                Session::put('filter_type' , []);
            }
        });
    }


}
