<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\BannerPackage;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminBannerPackageApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get banner package list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBannerPackagesList(Request $request)
    {
        try {
            // Get filter parameters
            $search = $request->get('search');
            $status = $request->get('status');
            
            // Start building the query
            $bannerPackagesQuery = BannerPackage::query();
            
            // Apply filters if provided
            if (!empty($search)) {
                $bannerPackagesQuery->where('name', 'like', '%' . $search . '%');
            }
            
            if (isset($status) && $status !== '') {
                $bannerPackagesQuery->where('status', $status);
            }
            
            // Order by name
            $bannerPackagesQuery->orderBy('name', 'asc');
            
            // Paginate results
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            
            $bannerPackagesData = $bannerPackagesQuery->paginate($perPage, ['*'], 'page', $page);
            
            return $this->apiResponse->success([
                'banner_packages' => $bannerPackagesData->items(),
                'pagination' => [
                    'total' => $bannerPackagesData->total(),
                    'per_page' => $bannerPackagesData->perPage(),
                    'current_page' => $bannerPackagesData->currentPage(),
                    'last_page' => $bannerPackagesData->lastPage()
                ]
            ], 'Banner packages fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching banner packages list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch banner packages list', 500);
        }
    }
}
