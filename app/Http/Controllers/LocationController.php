<?php
namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocationController extends Controller
{
    public function searchDistricts(Request $request)
    {
        $search = $request->input('search');
        $locale = App::getLocale();
        $searchName = 'name_'.$locale;
        return District::select("{$searchName} as name", "id")
            ->when($search, function($query) use ($search, $searchName) {
            return $query->where($searchName, 'LIKE', "%{$search}%");
        })
        ->limit(10)
        ->get();
    }

    public function getDistricts(Request $request)
    {
        $locale = App::getLocale();
        $searchName = 'name_'.$locale;
        return District::select("{$searchName} as name", "id")
            ->get();
    }

    public function getCitiesByDistrict(Request $request)
    {
        $districtId = $request->input('district_id');
        $locale = App::getLocale();
        $searchName = 'name_'.$locale;

        return City::select("{$searchName} as name", "id")->where('district_id', $districtId)
            ->orderBy($searchName)
            ->get();
    }
}
