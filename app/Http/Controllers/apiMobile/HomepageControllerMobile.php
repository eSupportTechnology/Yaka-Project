<?php

namespace App\Http\Controllers\apiMobile;

use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Cache;
use App\Models\Ads;

class HomepageControllerMobile extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get top and bottom banners
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopBottomBanners(ApiResponseService $apiResponse)
    {
        try {
            return Cache::remember('mobile_top_bottom_banners', 300, function () {

                $banners = Banners::where('type', 0)
                    ->select('id', 'img')
                    ->latest()
                    ->get()
                    ->map(function ($banner) {
                        return [
                            'id' => $banner->id,
                            'image_url' => asset('banners/' . $banner->img),
                        ];
                    });

                return $this->apiResponse->success($banners, 'Banner details fetched successfully');
            });
        } catch (\Exception $e) {
            Log::error('Top/Bottom banner fetch error: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch banners', 400);
        }
    }


    /**
     * Get Super Ads banners
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSuperAdsBanners()
    {
        try {
            return Cache::remember('mobile_super_ads_banners', 300, function () {
                $banners = Banners::where('type', 1)
                    ->select('id', 'img')
                    ->latest()
                    ->get()
                    ->map(function ($banner) {
                        return [
                            'id' => $banner->id,
                            'image_url' => asset('banners/' . $banner->img),
                        ];
                    });

                return $this->apiResponse->success($banners, 'Super Ads banners fetch successfully');
            });
        } catch (\Exception $e) {
            Log::error('Super Ads banner fetch error: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch super ads banners', 400);
        }
    }

    /**
     * Get Top Ads banners
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopAdsBanners()
    {
        try {
            // Clear existing cache to ensure fresh data
            Cache::forget('mobile_top_ads_banners');

            return Cache::remember('mobile_top_ads_banners', 300, function () {

                $banners = Banners::where(function($query) {
                       $query->where('type', 2)
                             ->orWhere('type', 3);
                    })
                    ->select('id', 'img')
                    ->latest()
                    ->get();
                if ($banners->isEmpty()) {
                    Log::info('No banners found with type 2 or 3, falling back to type 1 banners');
                    $banners = Banners::where('type', 1)
                        ->select('id', 'img')
                        ->latest()
                        ->limit(5)
                        ->get();
                }

                $mappedBanners = $banners->map(function ($banner) {
                    return [
                        'id' => $banner->id,
                        'image_url' => asset('banners/' . $banner->img),
                    ];
                });

                // Log counts for debugging
                Log::info('Top Ads banners fetched', ['count' => $mappedBanners->count()]);

                return $this->apiResponse->success($mappedBanners, 'Top Ads banners fetched successfully');
            });
        } catch (\Exception $e) {
            Log::error('Top Ads banner fetch error: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch top ads banners', 400);
        }
    }

    /**
     * Get Super Ads
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSuperAds()
    {
        try {
            $superAds = Ads::with(['category', 'subcategory'])
                ->where('ads_package', 6)
                ->where('status', 1)
                ->where(function($query) {
                    $query->whereNull('package_expire_at')
                          ->orWhere('package_expire_at', '>=', now());
                })
                ->latest()
                ->take(5)
                ->get();

            return $this->apiResponse->success($superAds, 'Super Ads fetched successfully');
        } catch (\Exception $e) {
            Log::error('Error fetching super ads: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch super ads', 400);
        }
    }

    /**
     * Get Top Ads
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopAds()
    {
        try {
            $topAds = Ads::with(['category', 'subcategory'])
                ->where('ads_package', 3)
                ->where('status', 1)
                ->where(function($query) {
                    $query->whereNull('package_expire_at')
                          ->orWhere('package_expire_at', '>=', now());
                })
                ->latest()
                ->take(5)
                ->get();

            return $this->apiResponse->success($topAds, 'Top Ads fetched successfully');
        } catch (\Exception $e) {
            Log::error('Error fetching top ads: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch top ads', 400);
        }
    }
     /**
     * Get Latest Ads
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLatestAds()
    {
        try {
            $latestAds = Ads::with(['category', 'subcategory'])
                ->where('ads_package', 4)
                ->where('status', 1)
                ->where(function($query) {
                    $query->whereNull('package_expire_at')
                          ->orWhere('package_expire_at', '>=', now());
                })
                ->latest()
                ->take(4)
                ->get();

            return $this->apiResponse->success($latestAds, 'Latest Ads fetched successfully');
        } catch (\Exception $e) {
            Log::error('Error fetching latest ads: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch latest ads', 400);
        }
    }

    /**
     * Get categories for home page with ad counts
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories(Request $request)
    {
        try {
            $categories = \App\Models\Category::where('status', 1)
                ->where('mainId', 0)
                ->withCount(['ads' => function ($query) {
                    $query->where('status', 1);
                }])
                ->get()
                ->map(function ($category) use ($request) {
                    if($request->query('ad_post') && $request->query('ad_post') == 1) {
                        return [
                            'id' => $category->id,
                            'name' => $category->name,
                        ];
                    } else {
                        return [
                            'id' => $category->id,
                            'name' => $category->name,
                            'url' => $category->url,
                            'image_url' => $category->image ? asset('images/Category/' . $category->image) : null,
                            //'free_ad_count' => $category->free_add_count,
                            'ads_count' => $category->ads_count,
                        ];
                    }
                });

            return $this->apiResponse->success($categories, 'categories fetched successfully');
        } catch (\Exception $e) {
            Log::error('categories fetch error: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch categories', 400);
        }
    }

}
