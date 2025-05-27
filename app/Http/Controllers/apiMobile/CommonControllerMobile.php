<?php

namespace App\Http\Controllers\apiMobile;

use App\Models\District;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Cache;

class CommonControllerMobile extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get all disricts
     */
    public function getDistricts()
    {
        try {
            $locale = App::getLocale();
            $searchName = 'name_'.$locale;
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
