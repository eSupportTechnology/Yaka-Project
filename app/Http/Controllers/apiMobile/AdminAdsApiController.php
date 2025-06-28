<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Log;

class AdminAdsApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get admin ad list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAdsList(Request $request)
    {
        try {
            // Get filter parameters
            $adCode = $request->get('code');
            $status = $request->get('status');
            $categoryId = $request->get('category_id');
            $subCategoryId = $request->get('sub_category_id');
            
            // Start building the query with related data
            $adsQuery = Ads::with([
                'category', 
                'subcategory', 
                'main_location', 
                'sub_location', 
                'user'
            ]);

            // Apply filters if provided
            if (!empty($adCode)) {
                $adsQuery->where('adsId', 'like', '%' . $adCode . '%');
            }

            if (isset($status) && $status !== '') {
                $adsQuery->where('status', $status);
            }

            if (!empty($categoryId)) {
                $adsQuery->where('cat_id', $categoryId);
            }

            if (!empty($subCategoryId)) {
                $adsQuery->where('sub_cat_id', $subCategoryId);
            }

            // Order by latest ads (newest first)
            $adsQuery->orderBy('created_at', 'desc');
            
            // Paginate results
            $perPage = $request->get('per_page', 20);
            $page = $request->get('page', 1);
            
            $adsData = $adsQuery->paginate($perPage, ['*'], 'page', $page);
            
            return $this->apiResponse->success([
                'ads' => $adsData->items(),
                'pagination' => [
                    'total' => $adsData->total(),
                    'per_page' => $adsData->perPage(),
                    'current_page' => $adsData->currentPage(),
                    'last_page' => $adsData->lastPage()
                ]
            ], 'Ads list fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching admin ads list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch ads list', 500);
        }
    }
    
    /**
     * Update ad status (approve/disapprove)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAdStatus(Request $request)
    {
        try {
            $request->validate([
                'ad_id' => 'required|string',
                'status' => 'required|boolean'
            ]);
            
            $adId = $request->input('ad_id');
            $status = $request->input('status');
            
            $ad = Ads::where('adsId', $adId)->first();
            
            if (!$ad) {
                return $this->apiResponse->error('Ad not found', 'Ad not found with the provided ID', 404);
            }
            
            $ad->status = $status;
            $ad->save();
            
            return $this->apiResponse->success($ad, 'Ad status updated successfully');
            
        } catch (\Exception $e) {
            Log::error('Error updating ad status: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to update ad status', 500);
        }
    }
}
