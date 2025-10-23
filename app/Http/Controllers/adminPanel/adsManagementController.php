<?php

namespace App\Http\Controllers\adminPanel;

use App\Models\Ads;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\MembershipAdUsage;
use App\Models\MembershipPackage;

class adsManagementController extends Controller
{

    public function index(Request $request)
    {
        $adCode = $request->get('code');
        $adsQuery = Ads::query();

        if (!empty($adCode)) {
            $adsQuery->where('adsId', 'like', '%' . $adCode . '%')
            ->orWhere('title', 'like', '%' . $adCode . '%');
        }

        // Order by latest ads (newest first)
        $adsQuery->orderBy('created_at', 'desc');

        $adsData = $adsQuery->paginate(100);
        return view('newAdminDashboard.adsManagement.index', compact('adsData'));
    }


    public function status($status, $id, Request $request)
{
    $ads = Ads::where('adsId', $id)->firstOrFail();
    $previousStatus = $ads->status;

    // --- APPROVE ---
    if ($status === 'approve') {
        $ads->status = 1;

        // If previously disapproved, deduct voucher again
        if ($previousStatus === 2 && $ads->voucher_amount_used == 0) {
            $membershipPackage = MembershipPackage::where('user_id', $ads->user_id)
                ->latest()
                ->first();

            if ($membershipPackage) {
                $price = (float) $ads->price;
                $availableVoucher = (float) ($membershipPackage->promotion_voucher_cost ?? 0);

                $voucherUsed = min($availableVoucher, $price);

                if ($voucherUsed > 0) {
                    $membershipPackage->promotion_voucher_cost -= $voucherUsed;
                    $membershipPackage->save();

                    $ads->voucher_amount_used = $voucherUsed;
                }
            }

            // also update ads usage count
            $ads->ads_count_used = 1;

            // add/update membership_ad_usages
            $usage = MembershipAdUsage::firstOrCreate(
                [
                    'membership_package_id' => $membershipPackage->id,
                    'user_id' => $ads->user_id,
                    'year' => now()->year,
                    'month' => now()->month,
                ],
                ['ads_used' => 0]
            );
            $usage->increment('ads_used');
        }

    // --- DISAPPROVE ---
    } elseif ($status === 'disapprove') {
        $ads->status = 2;

        // Restore voucher amount if any was used
        if ($ads->voucher_amount_used > 0) {
            $membershipPackage = MembershipPackage::where('user_id', $ads->user_id)
                ->latest()
                ->first();

            if ($membershipPackage) {
                $membershipPackage->promotion_voucher_cost += $ads->voucher_amount_used;
                $membershipPackage->save();
            }

            $ads->voucher_amount_used = 0;
        }

        // reset ads count usage
        if ($ads->ads_count_used > 0) {
            $ads->ads_count_used = 0;

            // decrease membership usage
            $usage = MembershipAdUsage::where('membership_package_id', $membershipPackage->id)
                ->where('user_id', $ads->user_id)
                ->where('year', now()->year)
                ->where('month', now()->month)
                ->first();

            if ($usage && $usage->ads_used > 0) {
                $usage->decrement('ads_used');
            }
        }

        $ads->reason = $request->query('reason');
    }

    $ads->save();

    try {
        $adsUser = User::where('id', $ads->user_id)->first();

        if ($status === 'approve') {
            $adUrl = env('APP_URL') . "/browse_ads_details/" . $ads->adsId;
            if ($adsUser->created_by == 2) {
                $message = "We've posted your ad for FREE on YAKA.LK!\nYour ad is now live: " . $adUrl . "\nContact: 0705321321";
            } else {
                $message = "We've approved your ad on YAKA.LK!\nYour ad is now live: " . $adUrl . "\nContact: 0705321321";
            }
        } else {
            $message = "Your ad has been disapproved due to: " . $request->query('reason') . ". Please review and submit again.\nContact: 0705321321";
        }

        OtpService::sendSingleSms($adsUser->phone_number, $message);
    } catch (\Exception $e) {
        // keep silent, no logs
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
