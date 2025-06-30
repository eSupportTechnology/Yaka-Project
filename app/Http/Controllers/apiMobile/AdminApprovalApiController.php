<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Log;

class AdminApprovalApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Approve an ad via API
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
            
            // Update ad status to approved (1)
            $ad->status = 1;
            $ad->save();
            
            // Send notification to user about ad approval
            try {
                $adsUser = User::where('id', $ad->user_id)->first();
                if ($adsUser) {
                    $adUrl = "https://yaka.lk/browse_ads_details/".$ad->adsId;
                    
                    // Different message based on who created the user
                    if($adsUser->created_by == 2) {
                        $message = "We've posted your ad for FREE on YAKA.LK!\nYour ad is now live: ".$adUrl."\nContact: 0705321321";
                    } else {
                        $message = "We've approved your ad on YAKA.LK!\nYour ad is now live: ".$adUrl."\nContact: 0705321321";
                    }
                    
                    OtpService::sendSingleSms($adsUser->phone_number, $message);
                }
            } catch (\Exception $e) {
                Log::error('Error sending approval notification: ' . $e->getMessage());
                // Continue execution even if notification fails
            }
            
            return $this->apiResponse->success($ad, 'Ad approved successfully');
            
        } catch (\Exception $e) {
            Log::error('Error approving ad via API: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to approve ad', 500);
        }
    }
}
