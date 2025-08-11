<?php

namespace App\Action\HomePage;

use App\Models\Ads;
use App\Services\ApiResponseService;
use Carbon\CarbonInterface;
use Exception;
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
            $ads = Ads::with(['user', 'main_location', 'sub_location'])
                ->where('status', 1)
                ->where(function ($query) {
                    $query->whereNull('package_expire_at')
                        ->orWhere('package_expire_at', '>=', now());
                })
                ->get()
                ->map(function ($ad) {

                    $locale = app()->getLocale();
                    $locationName = 'name_' . $locale;

                    $expiredIn = null;
                    if ($ad->package_expire_at) {
                        $diff = now()->diffForHumans($ad->package_expire_at, [
                            'parts' => 3,
                            'short' => true,
                            'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW
                        ]);
                        $expiredIn = $ad->package_expire_at->isPast() ? 'Expired' : $diff;
                    }

                    return [
                        'id' => $ad->id,
                        'title' => $ad->title,
                        'package_type' => $ad->ads_package,
                        'created_at' => $ad->created_at->translatedFormat('d M Y g:i a'),
                        'expired_in' => $expiredIn,
                        'location' => [
                            'city' => $ad->sub_location->$locationName ?? 'N/A',
                            'district' => $ad->main_location->$locationName ?? 'N/A',
                        ],
                        'posted_by' => [
                            'name' => trim(($ad->user->first_name ?? '') . ' ' . ($ad->user->last_name ?? '')),
                            'email' => $ad->user->email ?? 'N/A',
                            'phone' => $ad->user->phone_number ?? 'N/A'
                        ],
                    ];
                });

            $groupedAds = $ads->groupBy('package_type');

            $adsData = [
                'super_ads' => $groupedAds->get(6, collect()),
                'top_ads' => $groupedAds->get(3, collect()),
                'urgent_ads' => $groupedAds->get(4, collect()),
                'jump_up_ads' => $groupedAds->get(5, collect()),
                'normal_ads' => $groupedAds->get(0, collect()),
            ];

            return $this->apiResponse->success($adsData, 'Home page ads fetched successfully');

        } catch (Exception $e) {
            Log::error('Error fetching home page ads: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch home page ads', 500);
        }
    }
}
