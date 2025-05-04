<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\Ads;
use App\Models\Payment;
use App\Models\PaymentInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\IpgHashService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
            $invoiceId = request()->query('invId');
            $paymentInfo = PaymentInfo::where('invoice_id', $invoiceId)->first();
            if($paymentInfo->payment_status == 0) {
                return view('newFrontend.user.payment-confirming');
            } else if($paymentInfo->payment_status == 1) {
                // Decode ad data
                $adData = session($invoiceId.'ad_data');
                $this->saveAd($adData);
                return redirect()->route('user.my_ads')->with('success', 'Payment successful! Your ad has been posted.');
            } else {
                return view('newFrontend.user.payment-error');
            }
        } catch (\Exception $e) {
            Log::error('Payment processing error', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Payment failed due to a system error. Please try again later.');
        }
    }


    private function saveAd($adData)
    {
        try {
            $packageExpireAt = null;
            if ($adData['boosting_option'] != '0') {
                $packageType = \App\Models\PackageType::find($adData['package_type']);
                if ($packageType) {
                    $packageExpireAt = now()->addDays($packageType->duration);
                }
            }



            // Save Ad in Database
            Ads::create([
                'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'user_id' => auth()->user()->id,
                'title' => $adData['title'],
                'price' => $adData['price'],
                'description' => $adData['description'],
                'mainImage' => $adData['main_image'],
                'subImage' => json_encode($adData['sub_images']),
                'brand' => $adData['brand'],
                'model' => $adData['model'],
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
                'status' => '0',
            ]);

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
                $paymentInfo->payment_status = 1;
                $paymentInfo->save();
            }
        }
    }
}
