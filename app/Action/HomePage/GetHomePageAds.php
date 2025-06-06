<?php

namespace App\Action\HomePage;

use App\Models\Ads;
use Illuminate\Support\Facades\Log;

class GetHomePageAds
{
    public function __invoke(): array
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

            return $adsData;

        } catch (\Exception $e) {
            Log::error('Error fetching home page ads: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to fetch ads'];
        }
    }
}
