<?php

namespace App\Action\HomePage;

use App\Models\Ads;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class GetHomePageAds
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $ads = Ads::where('status', 1)
                ->where(function ($query) {
                    $query->whereNull('package_expire_at')
                        ->orWhere('package_expire_at', '>=', now());
                })
                ->get();

            $groupedAds = $ads->groupBy('ads_package');

            $adsData = [
                'super_ads' => $groupedAds->get(6, collect()),
                'top_ads' => $groupedAds->get(3, collect()),
                'urgent_ads' => $groupedAds->get(4, collect()),
                'jump_up_ads' => $groupedAds->get(5, collect()),
                'normal_ads' => $groupedAds->get(0, collect()),
            ];
            return $this->apiResponse->success($adsData, 'Home page ads fetched successfully');

        } catch (\Exception $e) {
            Log::error('Error fetching home page ads: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch home page ads', 500);
        }
    }
}
