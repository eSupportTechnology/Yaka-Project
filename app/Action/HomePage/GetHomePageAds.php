<?php

namespace App\Action\HomePage;

use App\Models\Ads;
use App\Services\ApiResponseService;
use Carbon\Carbon;
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
                    if (!empty($ad->package_expire_at)) {
                        try {
                            $expireDate = Carbon::parse($ad->package_expire_at);

                            $diff = now()->diffForHumans($expireDate, [
                                'parts' => 3,
                                'short' => true,
                                'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW
                            ]);
                            $expiredIn = $expireDate->isPast() ? 'Expired' : $diff;
                        } catch (\Exception $e) {
                            $expiredIn = 'Invalid date';
                        }
                    }

                    return [
                        'adsId' => $ad->id,
                        'user_id' => $ad->user_id,
                        'created_by_staff_id' => $ad->created_by_staff_id,
                        'title' => $ad->title,
                        'url' => $ad->url,
                        'sublocation' => $ad->sublocation,
                        'description' => $ad->description,
                        'price' => $ad->price,
                        'mainImage' => $ad->mainImage,
                        'subImage' => $ad->subImage,
                        'cat_id' => $ad->cat_id,
                        'sub_cat_id' => $ad->sub_cat_id,
                        'ads_package' => $ad->ads_package,
                        'package_type' => $ad->ads_package,
                        'package_expire_at' => $ad->package_expire_at,
                        'bump_up_at' => $ad->bump_up_at,
                        'view_count' => $ad->view_count,
                        'price_type' => $ad->price_type,
                        'brand' => $ad->brand,
                        'model' => $ad->model,
                        'post_type' => $ad->post_type,
                        'condition' => $ad->condition,
                        'status' => $ad->status,
                        'disapproval_reason' => $ad->disapproval_reason,
                        'rotation_position' => $ad->rotation_position,
                        'last_rotated_at' => $ad->last_rotated_at,
                        'invoice_id' => $ad->invoice_id,
                        'experience_years' => $ad->experience_years,
                        'education' => $ad->education,
                        'application_deadline' => $ad->application_deadline,
                        'mobile_number' => $ad->mobile_number,
                        'reason' => $ad->reason,

                        'created_at' => Carbon::parse($ad->created_at)->translatedFormat('d M Y g:i a'),
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
