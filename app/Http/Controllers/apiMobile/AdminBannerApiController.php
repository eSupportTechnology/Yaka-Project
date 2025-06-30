<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminBannerApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get banner list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBannersList(Request $request)
    {
        try {
            // Get filter parameters
            $search = $request->get('search');
            $type = $request->get('type');
            
            // Start building the query with banner package relationship
            $bannersQuery = Banners::with('bannerPackage');
            
            // Apply filters if provided
            if (!empty($search)) {
                $bannersQuery->where('url', 'like', '%' . $search . '%');
            }

            if (isset($type) && $type !== '') {
                $bannersQuery->where('type', $type);
            }

            // Order by latest first
            $bannersQuery->orderBy('created_at', 'desc');
            
            // Paginate results
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            
            $bannersData = $bannersQuery->paginate($perPage, ['*'], 'page', $page);
            
            // Format the data to match the required structure
            $formattedBanners = $bannersData->map(function ($banner) {
                $typeName = 'Unknown';
                $dimensions = '';
                
                if ($banner->type === 0) {
                    $typeName = 'Leaderboard';
                    $dimensions = '(1140x180)';
                } elseif ($banner->type === 1) {
                    $typeName = 'Skyscraper';
                    $dimensions = '(285x500)';
                }
                
                return [
                    'id' => $banner->id,
                    'image' => asset('banners/' . $banner->img),
                    'type' => $typeName . ' ' . $dimensions,
                    'type_code' => $banner->type,
                    'url' => $banner->url,
                    'package_name' => $banner->bannerPackage ? $banner->bannerPackage->name : 'N/A',
                    'package_duration' => $banner->bannerPackage ? $banner->bannerPackage->no_of_days : 'N/A',
                    'expired_at' => $banner->expired_at
                ];
            });
            
            return $this->apiResponse->success([
                'banners' => $formattedBanners,
                'pagination' => [
                    'total' => $bannersData->total(),
                    'per_page' => $bannersData->perPage(),
                    'current_page' => $bannersData->currentPage(),
                    'last_page' => $bannersData->lastPage()
                ]
            ], 'Banners list fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching banners list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch banners list', 500);
        }
    }
}
