<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Log;

class AdminDisapprovalApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
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
            
            // Update the ad status to disapproved (2) and save the reason
            $ad->status = 2; 
            $ad->disapproval_reason = $reason;
            $ad->save();
            
            // Send notification to user about ad disapproval
            try {
                $adsUser = User::where('id', $ad->user_id)->first();
                if ($adsUser) {
                    $message = "Your ad \"{$ad->title}\" was not approved. Reason: {$reason}. Please update and resubmit. For help, contact 0705321321.";
                    OtpService::sendSingleSms($adsUser->phone_number, $message);
                }
            } catch (\Exception $e) {
                Log::error('Error sending disapproval notification: ' . $e->getMessage());
                // Continue even if SMS notification fails
            }
            
            return $this->apiResponse->success(
                [
                    'ad_id' => $adId,
                    'status' => 'disapproved',
                    'reason' => $reason
                ], 
                'Ad disapproved successfully'
            );
            
        } catch (\Exception $e) {
            Log::error('Error disapproving ad: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to disapprove ad', 500);
        }
    }
}
