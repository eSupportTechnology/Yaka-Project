<?php

namespace App\Http\Controllers\adminPanel;

use App\Models\Ads;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class adsManagementController extends Controller
{

    public function index(Request $request)
    {
        $adCode = $request->get('code');
        $adsQuery = Ads::query();

        if (!empty($adCode)) {
            $adsQuery->where('adsId', 'like', '%' . $adCode . '%');
        }

        // Order by latest ads (newest first)
        $adsQuery->orderBy('created_at', 'desc');

        $adsData = $adsQuery->paginate(100);
        return view('newAdminDashboard.adsManagement.index', compact('adsData'));
    }


    public function status($status, $id)
    {
        $ads = Ads::where('adsId', $id)->firstOrFail();
        $ads->status = $status === 'disapprove' ? 0 : 1;
        $ads->save();
        try {
            $adsUser = User::where('id', $ads->user_id)->first();
            if($status !== 'disapprove') {
                $adUrl = "https://yaka.lk/browse_ads_details/".$ads->adsId;
                $message = "🎉 We've posted your ad for FREE on YAKA.LK!\nYour ad is now live: ".$adUrl."\n📞 Contact for more: 0705321321\nYAKA.LK - Sri Lanka's trusted ad platform!";
                OtpService::sendSingleSms($adsUser->phone_number, $message);
            }

        } catch (\Exception $e) {
            Log::info($e);
        }

        return redirect()->route('dashboard.ads')->with('message', 'Ad status updated successfully');
    }


    public function getTopAds()
   {
    // Fetch only top ads that are approved (status = 1)
    $topAds = Ads::with('category', 'subcategory', 'main_location', 'sub_location')
                ->where('is_top_ad', 1) // Filtering only top ads
                ->where('status', 1) // Only approved ads
                ->orderBy('id', 'DESC')
                ->take(10) // Limit to 10 ads for the slideshow
                ->get();

    return response()->json($topAds);
    }

}
