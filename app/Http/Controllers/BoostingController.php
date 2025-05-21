<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoostingAddInfo;
use App\Services\IpgHashService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Ads;
use App\Models\AdBoostPaymentInfo;
use Illuminate\Support\Facades\Session;


class BoostingController extends Controller
{
    
    public function saveInfo(Request $request)
{
    $data = $request->validate([
        'ad_id' => 'required|integer',
        'ad_title' => 'required|string',
        'ad_description' => 'nullable|string',
        'ad_price' => 'required|numeric',
        'current_package_id' => 'nullable|integer',
        'current_package_name' => 'nullable|string',
        'current_package_type_id' => 'nullable|integer',
        'current_package_duration' => 'nullable|integer',
        'current_package_expiry' => 'nullable|string',
        'new_package_id' => 'required|integer',
        'new_package_name' => 'required|string',
        'new_package_type_id' => 'required|integer',
        'new_package_duration' => 'required|integer',
        'amount' => 'required|numeric',
        'payment_status' => 'required|string',
        'invoice_id' => 'required|string'
    ]);

    $info = BoostingAddInfo::create($data);

    return response()->json([
        'success' => true,
        'redirect' => route('boosting.billingDetails')
    ]);
}

public function showBillingDetails()
{
$invoiceId = session('invoiceId');

    $boostingInfo = BoostingAddInfo::where('invoice_id', $invoiceId)->latest()->first();

    if (!$boostingInfo) {
        abort(404, 'Boosting information not found.');
    }

    // Only pick the 4 requested fields
    $billingData = [
        'new_package_name' => $boostingInfo->new_package_name,
        'new_package_type_id' => $boostingInfo->new_package_type_id,
        'new_package_duration' => $boostingInfo->new_package_duration,
        'amount' => $boostingInfo->amount,
        'invoice_id' => $invoiceId
    ];

    $checkValue = IpgHashService::hash($boostingInfo->amount, $invoiceId);
    session(['checkBoostValue' => $checkValue]);


    return view('newFrontend.user.adboostbilling', compact('billingData','invoiceId','checkValue'));
}


public function updateBoost(Request $request)
{
    try {
        // Log full request for debugging
        Log::info('Received payment update request:', $request->all());

        // Extract invoice number and status message
        $invoiceNo = $request['invoiceNo'] ?? null;
        $statusMessage = $request['statusMessage'] ?? null;
        $checkValue = $request->input('checkValue');

        Log::debug('checkValue: ' . $checkValue);


        if (!$invoiceNo) {
            throw new \Exception('Invoice number is missing.');
        }

        // Only proceed if status is 'SUCCESS'
        if (strtoupper($statusMessage) === 'SUCCESS') {

            // Fetch BoostingAddInfo record using invoice ID
            $boostingInfo = BoostingAddInfo::where('invoice_id', $invoiceNo)->first();

            if (!$boostingInfo) {
                throw new \Exception("No boosting info found for invoice ID: $invoiceNo");
            }

            // Get the related ad
            $ad = Ads::where('adsId', $boostingInfo->ad_id)->first();

            if (!$ad) {
                throw new \Exception("Ad not found with ID: " . $boostingInfo->ad_id);
            }

            // Calculate the new package expiry
            $newExpiryDate = Carbon::now()->addDays($boostingInfo->new_package_duration);

            // Update the ad with new package details
            $ad->update([
                'ads_package' => $boostingInfo->new_package_id,
                'package_type' => $boostingInfo->new_package_type_id,
                'package_expire_at' => $newExpiryDate,
            ]);

            

            // ✅ Save boost payment info
            AdBoostPaymentInfo::create([
                'invoice_id'  => $invoiceNo,
                'check_value' => $checkValue,
                'ads_id'      => $ad->adsId,
                'user_id'     => $ad->user_id,
            ]);

            // Log success
            Log::info('Ad package successfully updated after payment.', [
                'ad_id' => $boostingInfo->ad_id,
                'invoice_id' => $invoiceNo
            ]);

            return response()->json(['success' => true, 'message' => 'Ad package updated successfully.']);

        } else {
            Log::warning("Payment status not successful. Skipping ad update.", [
                'invoice_id' => $invoiceNo,
                'status' => $statusMessage
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment status was not SUCCESS. Update skipped.',
                'statusMessage' => $statusMessage
            ], 400);
        }

    } catch (\Exception $e) {
        Log::error('Error updating ad boost:', [
            'error' => $e->getMessage(),
            'invoiceNo' => $request->input('invoiceNo'),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Failed to update ad package.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    
    
}
