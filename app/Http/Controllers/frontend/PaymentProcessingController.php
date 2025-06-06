<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\Ads;
use App\Models\User;
use App\Models\Payment;
use App\Models\PaymentInfo;
use Illuminate\Support\Str;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Services\IpgHashService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;


class PaymentProcessingController extends Controller
{
    public function show(Request $request)
    {
        $packageId = session('package_id');
        $packageType = session('package_type');
        $selectedPackageName = session('selected_package_name');
        $selectedPackagePrice = session('selected_package_price');
        $selectedPackageDuration = session('selected_package_duration');
        $adData = session('ad_data');

        $invoiceId = "YKAD".date('YmsHsi');
        $checkValue = IpgHashService::hash($selectedPackagePrice, $invoiceId);
        PaymentInfo::create([
            'check_value' => $checkValue,
            'invoice_id' => $invoiceId,
            'ad_data' => $adData,
            'user_id' => auth()->user()->id
        ]);

        session(['checkValue' => $checkValue]);
        session(['invoiceId' => $invoiceId]);
        session([$invoiceId.'add_data' => $adData]);

        return view('newFrontend.user.payment', compact(
            'selectedPackageName',
            'selectedPackageDuration',
            'selectedPackagePrice',
            'packageType',
            'adData',
            'checkValue',
            'invoiceId',
        ));
    }

    public function complete(Request $request)
    {
        try {
            $invoiceId = $request->query('invId');
            $paymentInfo = PaymentInfo::where('invoice_id', $invoiceId)->first();
            if($paymentInfo->payment_status == 0) {
                return view('newFrontend.user.payment-confirming');
            } else if($paymentInfo->payment_status == 1) {
                // Decode ad data

                return redirect()->route('user.my_ads')->with('success', 'Payment successful! Your ad has been posted.');
            } else {
                return view('newFrontend.user.payment-error');
            }
        } catch (\Exception $e) {
            Log::error('Payment processing error', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Payment failed due to a system error. Please try again later.');
        }
    }


    private function saveAd($adData, $invoiceId, $userId)
    {
        try {
            $packageExpireAt = null;
            if ($adData['boosting_option'] != '0') {
                $packageType = \App\Models\PackageType::find($adData['package_type']);
                if ($packageType) {
                    $packageExpireAt = now()->addDays((int)($packageType->duration));
                }
            }
            $user = User::where('id', $userId)->first();
            if($adData['boosting_option'] == 6) {
                Artisan::call('ads:rotate-super');
            } elseif($adData['boosting_option'] == 3) {
                Artisan::call('ads:rotate-top');
            } elseif($adData['boosting_option'] == 4) {
                Artisan::call('ads:rotate-urgent');
            } elseif($adData['boosting_option'] == 5) {
                Artisan::call('ads:rotate-jump');
            }
            // Save Ad in Database
            Ads::create([
                'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'invoice_id' => $invoiceId,
                'user_id' => $userId,
                'title' => $adData['title'],
                'price' => $adData['price'],
                'description' => $adData['description'],
                'mainImage' => $adData['main_image'],
                'subImage' => json_encode($adData['sub_images']),
                'brand' => $adData['brand'] ?? 'N/A',
                'model' => $adData['model'] ?? 'N/A',
                'price_type' => $adData['pricing_type'] ?? null,
                'post_type' => $adData['post_type'] ?? null,
                'condition' => $adData['condition'] ?? null,
                'ads_package' => $adData['boosting_option'],
                'package_type' => $adData['package_type'],
                'package_expire_at' => $packageExpireAt,
                'cat_id' => $adData['cat_id'],
                'sub_cat_id' => $adData['sub_cat_id'],
                'location' => $adData['location'],
                'sublocation' => $adData['sublocation'],
                'rotation_position' => -1,
                'last_rotated_at' => now(),
                'status' => '0',
            ]);
            OtpService::sendSingleSms($user->phone_number, "Payment received for '{$invoiceId}'. Your ad will be published after admin approval. Thank you!");
            Log::info('Ad saved successfully.');
            //  return redirect()->route('user.my_ads')->with('success', 'Ad posted successfully!');

        } catch (\Exception $e) {
            Log::error('Error in saving ad', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Process Payment information
     */
    public function getPaymentInfo(Request $request)
    {
        Log::info("Payment Status: ".$request);
        $invoiceNo = $request['invoiceNo'] ?? null;
        $statusMessage = $request['statusMessage'] ?? null;

        if($statusMessage == 'SUCCESS') {
            $paymentInfo = PaymentInfo::where('invoice_id', $invoiceNo)->first();
            if($paymentInfo) {

                $adData = $paymentInfo->ad_data;
                $this->saveAd($adData, $paymentInfo->invoice_id, $paymentInfo->user_id);

                $paymentInfo->payment_status = 1;
                $paymentInfo->save();
            }
        }
    }
}
