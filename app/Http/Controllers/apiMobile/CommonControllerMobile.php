<?php

namespace App\Http\Controllers\apiMobile;

use App\Models\District;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class CommonControllerMobile extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get all districts or a specific district with its cities
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts(Request $request)
    {
        try {
            $locale = App::getLocale();
            $searchName = 'name_'.$locale;
            $districtId = $request->query('district_id');
            
            // If district_id is provided, return that district with its cities
            if ($districtId) {
                $district = District::find($districtId);
                
                if (!$district) {
                    return $this->apiResponse->error('District not found', 'District not found', 404);
                }
                
                $cities = $district->cities()->get()->map(function ($city) use ($searchName) {
                    return [
                        'id' => $city->id,
                        'name' => $city->$searchName,
                    ];
                });
                
                $result = [
                    'district' => [
                        'id' => $district->id,
                        'name' => $district->$searchName,
                    ],
                    'cities' => $cities
                ];
                
                return $this->apiResponse->success($result, 'District with cities fetched successfully');
            }
            
            // Otherwise return all districts (existing functionality)
            return Cache::remember('districts', 300, function () use ($searchName) {

                $districts = District::all()
                    ->map(function ($district) use ($searchName) {
                        return [
                            'id' => $district->id,
                            'name' => $district->$searchName,
                        ];
                    });

                return $this->apiResponse->success($districts, 'Districts details fetched successfully');
            });
        } catch (\Exception $e) {
            Log::error('Districts details fetch error: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch districts details', 400);
        }
    }
}
