<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{ app()->setlocale(Session::get('locale'));

    $search = $request->search;

    $adsdata1 = Ads::with('user', 'main_location', 'sub_location', 'category', 'subcategory')->where(function ($query) use ($search) {
        $query->where('title', 'like', "%$search%")
            ->where('status', '1')
            ->orWhere('description', 'like', "%$search%");
    })
        ->orWhereHas('user', function ($query) use ($search) {
            $query->where('first_name', 'like', "%$search%")
            ->where('last_name', 'like', "%$search%");
        })
        ->orWhereHas('category', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('subcategory', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('main_location', function ($query) use ($search) {
            $query->where('url', 'like', "%$search%");
        })
        ->orWhereHas('sub_location', function ($query) use ($search) {
            $query->where('name_en', 'like', "%$search%");
        })
        ->where('status','1')->paginate(9);



        if(count($adsdata1) > 0){
            $adsdata = [];

            foreach($adsdata1 as $ad){

                if($ad->status == 1){
                    $adsdata[] = $ad;
                }
            };
            if(count($adsdata)){
                return view('web.search',compact('adsdata'));
            }else{
                return view('web.empty');
            }
        }else{
            return view('web.empty');
        }


        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ads $ads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ads $ads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ads $ads)
    {
        //
    }
}
