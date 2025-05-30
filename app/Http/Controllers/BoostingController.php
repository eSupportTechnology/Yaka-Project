<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ads;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Models\BoostingAddInfo;
use App\Services\IpgHashService;
use App\Models\AdBoostPaymentInfo;
use Illuminate\Support\Facades\Log;
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

    // Save or update BoostingAddInfo
    $info = BoostingAddInfo::updateOrCreate(
        ['invoice_id' => $data['invoice_id']],  // search by this
        $data // update or insert with this data
    );

    // Get the related ad to extract user_id
    $ad = Ads::where('adsId', $data['ad_id'])->first();

    if (!$ad) {
        return response()->json([
            'success' => false,
            'message' => 'Ad not found for the given ad_id.'
        ], 404);
    }

    // Save or update AdBoostPaymentInfo
    AdBoostPaymentInfo::updateOrCreate(
        ['invoice_id' => $data['invoice_id']], // search key
        [
            'check_value'    => IpgHashService::hash($data['amount'], $data['invoice_id']),
            'ads_id'         => $data['ad_id'],
            'user_id'        => auth()->user()->id,
            'payment_status' => 0
        ]
    );

    // Store invoice ID in session
    session(['invoiceId' => $data['invoice_id']]);

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
            $newExpiryDate = Carbon::now()->addDays((int)($boostingInfo->new_package_duration));

            // Update the ad with new package details
            $ad->update([
                'ads_package' => $boostingInfo->new_package_id,
                'package_type' => $boostingInfo->new_package_type_id,
                'package_expire_at' => $newExpiryDate,
            ]);

            //  Update payment status
            AdBoostPaymentInfo::where('invoice_id', $invoiceNo)->update(['payment_status' => 1]);
            $user = User::where('id', $ad->user_id)->first();
            OtpService::sendSingleSms($user->phone_number, "Payment received for '{$invoiceNo}'. Your ad boosted successfully. Thank you!");
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


public function boostcomplete(Request $request)
{
    try {
        $invoiceId = $request->query('invId');

        // Retrieve payment info based on invoice ID
        $paymentInfo = AdBoostPaymentInfo::where('invoice_id', $invoiceId)->first();

        // If no record found, show error page
        if (!$paymentInfo) {
            return view('newFrontend.user.payment-error')->with('error', 'Payment record not found.');
        }

        // Check payment status
        if ($paymentInfo->payment_status == 0) {
            return view('newFrontend.user.payment-confirming');
        } elseif ($paymentInfo->payment_status == 1) {
            return redirect()->route('user.my_ads')->with('success', 'Payment successful! Your ad has been updated.');
        } else {
            return view('newFrontend.user.payment-error')->with('error', 'Invalid payment status.');
        }

    } catch (\Exception $e) {
        Log::error('Payment processing error', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Payment failed due to a system error. Please try again later.');
    }
}




}
