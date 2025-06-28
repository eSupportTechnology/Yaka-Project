<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminDashboardApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get ads count by status (pending, approved, disapproved)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAdsCounts()
    {
        try {
            $pendingAdsCount = Ads::where('status', 0)->count();
            $approvedAdsCount = Ads::where('status', 1)->count();
            $disapprovedAdsCount = Ads::where('status', 2)->count();
            
            $data = [
                'pending_ads_count' => $pendingAdsCount,
                'approved_ads_count' => $approvedAdsCount,
                'disapproved_ads_count' => $disapprovedAdsCount
            ];
            
            return $this->apiResponse->success($data, 'Ads counts fetched successfully');
        } catch (\Exception $e) {
            Log::error('Error fetching ads counts: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch ads counts', 500);
        }
    }
}
