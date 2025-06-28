<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\User;
use App\Services\OtpService;
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

    /**
     * Approve an ad
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveAd(Request $request)
    {
        try {
            $request->validate([
                'ad_id' => 'required|string'
            ]);
            
            $adId = $request->input('ad_id');
            
            $ad = Ads::where('adsId', $adId)->first();
            
            if (!$ad) {
                return $this->apiResponse->error('Ad not found', 'Ad not found with the provided ID', 404);
            }
            
            $ad->status = 1; // Set to approved
            $ad->save();
            
            // Send notification to user about ad approval
            try {
                $adsUser = User::where('id', $ad->user_id)->first();
                $adUrl = "https://yaka.lk/browse_ads_details/".$ad->adsId;
                $message = "We've posted your ad for FREE on YAKA.LK!\nYour ad is now live: ".$adUrl."\nContact: 0705321321";
                OtpService::sendSingleSms($adsUser->phone_number, $message);
            } catch (\Exception $e) {
                Log::error('Error sending approval notification: ' . $e->getMessage());
            }
            
            return $this->apiResponse->success($ad, 'Ad approved successfully');
            
        } catch (\Exception $e) {
            Log::error('Error approving ad: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to approve ad', 500);
        }
    }

    /**
     * Disapprove an ad with a reason
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function disapproveAd(Request $request)
    {
        try {
            $request->validate([
                'ad_id' => 'required|string',
                'reason' => 'required|string|max:1000'
            ]);
            
            $adId = $request->input('ad_id');
            $reason = $request->input('reason');
            
            $ad = Ads::where('adsId', $adId)->first();
            
            if (!$ad) {
                return $this->apiResponse->error('Ad not found', 'Ad not found with the provided ID', 404);
            }
            
            $ad->status = 2; // Set to disapproved (assuming 2 is the code for disapproved)
            $ad->disapproval_reason = $reason;
            $ad->save();
            
            // Send notification to user about ad disapproval
            try {
                $adsUser = User::where('id', $ad->user_id)->first();
                $message = "Your ad \"{$ad->title}\" was not approved. Reason: {$reason}. Please update and resubmit. For help, contact 0705321321.";
                OtpService::sendSingleSms($adsUser->phone_number, $message);
            } catch (\Exception $e) {
                Log::error('Error sending disapproval notification: ' . $e->getMessage());
            }
            
            return $this->apiResponse->success($ad, 'Ad disapproved successfully');
            
        } catch (\Exception $e) {
            Log::error('Error disapproving ad: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to disapprove ad', 500);
        }
    }

    /**
     * Handle both approval and disapproval in one endpoint
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function moderateAd(Request $request)
    {
        try {
            $request->validate([
                'ad_id' => 'required|string',
                'action' => 'required|string|in:approve,disapprove',
                'reason' => 'required_if:action,disapprove|nullable|string|max:1000'
            ]);
            
            $adId = $request->input('ad_id');
            $action = $request->input('action');
            $reason = $request->input('reason');
            
            $ad = Ads::where('adsId', $adId)->first();
            
            if (!$ad) {
                return $this->apiResponse->error('Ad not found', 'Ad not found with the provided ID', 404);
            }
            
            $adsUser = User::where('id', $ad->user_id)->first();
            if (!$adsUser) {
                Log::error('User not found for ad', ['ad_id' => $adId, 'user_id' => $ad->user_id]);
                return $this->apiResponse->error('User not found', 'User associated with this ad not found', 404);
            }
            
            if ($action === 'approve') {
                $ad->status = 1; // Set to approved
                $ad->disapproval_reason = null; // Clear any previous disapproval reason
                $ad->save();
                
                // Send approval notification
                try {
                    $adUrl = "https://yaka.lk/browse_ads_details/".$ad->adsId;
                    $message = "We've posted your ad for FREE on YAKA.LK!\nYour ad is now live: ".$adUrl."\nContact: 0705321321";
                    OtpService::sendSingleSms($adsUser->phone_number, $message);
                } catch (\Exception $e) {
                    Log::error('Error sending approval notification: ' . $e->getMessage());
                }
                
                return $this->apiResponse->success($ad, 'Ad approved successfully');
            } else {
                // Handle disapproval
                $ad->status = 2; // Set to disapproved 
                $ad->disapproval_reason = $reason;
                $ad->save();
                
                // Send disapproval notification
                try {
                    $message = "Your ad \"{$ad->title}\" was not approved. Reason: {$reason}. Please update and resubmit. For help, contact 0705321321.";
                    OtpService::sendSingleSms($adsUser->phone_number, $message);
                } catch (\Exception $e) {
                    Log::error('Error sending disapproval notification: ' . $e->getMessage());
                }
                
                return $this->apiResponse->success($ad, 'Ad disapproved successfully');
            }
            
        } catch (\Exception $e) {
            Log::error('Error moderating ad: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to moderate ad', 500);
        }
    }
}
