<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Ads;
use App\Services\ApiResponseService;

class AdsApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function adsSearch(Request $request): JsonResponse
    {
        try {
            $adCode = $request->get('code');
            $adsQuery = Ads::query();

            if (!empty($adCode)) {
                $adsQuery->where('adsId', 'like', '%' . $adCode . '%');
            }

            $adsQuery->orderBy('created_at', 'desc');

            $ads = $adsQuery->get();

            return $this->apiResponse->success($ads, 'Ads fetched successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch ads', 500);
        }
    }

}
