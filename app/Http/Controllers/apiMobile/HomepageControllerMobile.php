<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomepageControllerMobile extends Controller
{
    /**
     * Get home page banners for the mobile app

     * @return \Illuminate\Http\JsonResponse
     */
    public function getHomeBanners()
    {
        try {
            // Use cache to improve performance (cache for 30 minutes)
            return Cache::remember('mobile_home_banners', 1800, function () {
                // Get regular banners (type 0)
                $regularBanners = Banners::where('type', 0)
                    ->select('id', 'img', 'type', 'created_at')
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->map(function ($banner) {
                        return [
                            'id' => $banner->id,
                            'type' => $banner->type,
                            'image_url' => asset('banners/' . $banner->img),
                            //'created_at' => $banner->created_at->toIso8601String(),
                        ];
                    });

                // Get top/featured banners (type 1)
                $topBanners = Banners::where('type', 1)
                    ->select('id', 'img', 'type', 'created_at')
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->map(function ($banner) {
                        return [
                            'id' => $banner->id,
                            'type' => $banner->type,
                            'image_url' => asset('banners/' . $banner->img),
                            'created_at' => $banner->created_at->toIso8601String(),
                        ];
                    });

                // Return structured response
                return response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Banners fetched successfully',
                    'data' => [
                        'regular_banners' => $regularBanners,
                        'top_banners' => $topBanners,
                        'count' => [
                            'regular' => $regularBanners->count(),
                            'top' => $topBanners->count(),
                            'total' => $regularBanners->count() + $topBanners->count()
                        ]
                    ]
                ], 200);
            });
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Banner fetch error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return a friendly error to the client
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Failed to fetch banners',
                'error' => config('app.debug') ? $e->getMessage() : 'Server error'
            ], 500);
        }
    }

    /**
     * Get top and bottom banners
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopBottomBanners()
    {
        try {
            // Use short cache time (5 minutes) to ensure freshness while reducing DB load

            return Cache::remember('mobile_top_bottom_banners', 300, function () {
                // Get only what we need - no unused fields
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

                return response()->json([
                    'status' => 'success',
                    'data' => $banners
                ], 200);
            });
        } catch (\Exception $e) {
            Log::error('Top/Bottom banner fetch error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to fetch banners'
            ], 500);
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

                return response()->json([
                    'status' => 'success',
                    'data' => $banners
                ], 200);
            });
        } catch (\Exception $e) {
            Log::error('Super Ads banner fetch error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to fetch super ads banners'
            ], 500);
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

                return response()->json([
                    'status' => 'success',
                    'data' => $mappedBanners
                ], 200);
            });
        } catch (\Exception $e) {
            Log::error('Top Ads banner fetch error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to fetch top ads banners'
            ], 500);
        }
    }
}
