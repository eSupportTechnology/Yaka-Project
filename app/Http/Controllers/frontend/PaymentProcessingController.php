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
use App\Models\AdDetail;
use App\Models\FormField;
use App\Models\MembershipAdUsage;
use App\Models\MembershipPackage;
use App\Models\PackageType;
use App\Services\PusherNotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;


class PaymentProcessingController extends Controller
{

    private $pusherService;

    public function __construct(PusherNotificationService $pusherService)
    {
        $this->pusherService = $pusherService;
    }
    public function show(Request $request)
    {
        $packageId = session('package_id');
        $packageType = session('package_type');
        $selectedPackageName = session('selected_package_name');
        $selectedPackagePrice = session('selected_package_price');
        $selectedPackageDuration = session('selected_package_duration');
        $adData = session('ad_data');
        $user = auth()->user();
        // $price = (float) $request->price;

        $invoiceId = "YKAD" . date('YmsHsi');
        // if (!empty($price) && $price > 0) {
        //     $checkSource = 'price';
        //     $checkValue = IpgHashService::hash($price, $invoiceId);
        // } else {
            $checkSource = 'selectedPackagePrice';
            $checkValue = IpgHashService::hash($selectedPackagePrice, $invoiceId);
        // }

        PaymentInfo::create([
            'check_value' => $checkValue,
            'invoice_id' => $invoiceId,
            'ad_data' => $adData ?? json_encode($request->only(['price', 'promotion_voucher_cost', 'ads_per_month', 'valid_month'])),
            'user_id' => $user->id,
        ]);

        session([
            'checkValue' => $checkValue,
            'invoiceId' => $invoiceId,
            'membership_data' => $request->all(),
            $invoiceId . '_add_data' => $request->only(['price', 'promotion_voucher_cost', 'ads_per_month', 'valid_month'])
        ]);

        // Find active membership
        $activeMembership = MembershipPackage::where('user_id', $user->id)
            ->where('expiry_date', '>', now())
            ->where('promotion_voucher_cost', '>', 0)
            ->first();

        Log::info('Payment Debug', [
            'invoiceId' => $invoiceId,
            'checkValue' => $checkValue,
            'checkSource' => $checkSource,
            // 'price' => $price,
            'selectedPackagePrice' => $selectedPackagePrice
        ]);


        return view('newFrontend.user.payment', [
            'selectedPackageName' => $selectedPackageName,
            'selectedPackageDuration' => $selectedPackageDuration,
            'selectedPackagePrice' => $selectedPackagePrice,
            'packageType' => $packageType,
            'adData' => $adData,
            'checkValue' => $checkValue,
            'invoiceId' => $invoiceId,
            'activeMembership' => $activeMembership,
            // 'price' => $price,
            'membershipData' => $request->all(),
        ]);
    }


    public function freeComplete(Request $request)
    {
        try {
            $invoiceId = $request->input('invoiceId');
            $rawAdData = $request->input('adData');

            // Decode ad data safely
            if (is_string($rawAdData)) {
                $adData = json_decode($rawAdData, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning('freeComplete: adData JSON decode failed', [
                        'invoice_id' => $invoiceId,
                        'json_error' => json_last_error_msg(),
                        'rawAdData' => $rawAdData
                    ]);
                    $adData = [];
                }
            } else {
                $adData = $rawAdData ?? [];
            }

            Log::info('freeComplete called', ['invoice' => $invoiceId, 'adData' => $adData]);

            $payment = PaymentInfo::where('invoice_id', $invoiceId)->first();
            if (!$payment) {
                return response()->json(['success' => false, 'message' => 'Payment record not found']);
            }

            // Mark payment as completed
            $payment->payment_status = 1;
            $payment->save();

            $userId = $adData['user_id'] ?? null;
            $voucherRequested = isset($adData['voucher_amount']) ? (float) $adData['voucher_amount'] : 0.0;
            $selectedPackagePrice = isset($adData['selected_package_price'])
                ? (float) $adData['selected_package_price']
                : (float) ($adData['price'] ?? 0.0);

            // Resolve MembershipPackage
            $membershipPackage = null;
            if (!empty($adData['membership_package_id'])) {
                $membershipPackage = MembershipPackage::find($adData['membership_package_id']);
            } elseif (!empty($userId)) {
                $membershipPackage = MembershipPackage::where('user_id', $userId)->latest()->first();
            }

            // Handle vouchers
            $voucherUsed = 0;
            if ($voucherRequested > 0 && $membershipPackage) {
                $availableVoucher = (float) ($membershipPackage->promotion_voucher_cost ?? 0.0);

                $voucherUsed = min($voucherRequested, $availableVoucher, $selectedPackagePrice);

                if ($voucherUsed > 0) {
                    $membershipPackage->promotion_voucher_cost = max(0, $availableVoucher - $voucherUsed);
                    $membershipPackage->save();
                }

                Log::info('Voucher cost updated successfully', [
                    'membership_package_id'       => $membershipPackage->id,
                    'voucher_amount_requested'    => $voucherRequested,
                    'voucher_amount_used'         => $voucherUsed,
                    'previous_voucher_cost'       => $availableVoucher,
                    'new_voucher_cost'            => $membershipPackage->promotion_voucher_cost,
                    'invoice_id'                  => $invoiceId
                ]);
            }

            // -------------------------
            // ENFORCE MONTHLY QUOTA
            // -------------------------
            $currentYear = now()->year;
            $currentMonth = now()->month;

            if ($membershipPackage) {
                // Check validity
                if ($membershipPackage->expiry_date && $membershipPackage->expiry_date < now()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Your package has expired. Please renew to post more ads.'
                    ]);
                }

                // Get or create monthly usage record
                $usage = MembershipAdUsage::firstOrCreate(
                    [
                        'membership_package_id' => $membershipPackage->id,
                        'user_id' => $userId,
                        'year' => $currentYear,
                        'month' => $currentMonth,
                    ],
                    ['ads_used' => 0]
                );

                // Check if quota exceeded
                if ($usage->ads_used >= $membershipPackage->ads_per_month) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Monthly ad limit reached. Please wait until next month.'
                    ]);
                }

                // Deduct one ad
                $usage->increment('ads_used');
            }

            // -------------------------
            // PACKAGE EXPIRY HANDLING
            // -------------------------
            $packageExpireAt = null;
            if (isset($adData['boosting_option']) && $adData['boosting_option'] != '0') {
                $packageType = PackageType::find($adData['package_type'] ?? null);
                if ($packageType) {
                    $packageExpireAt = Carbon::now()->addDays((int) ($packageType->duration));
                }
            } else {
                $packageExpireAt = Carbon::now()->addDays(180);
            }

            $brand = $adData['brand'] ?? 'no brand';
            $model = $adData['model'] ?? 'no model';

            // -------------------------
            // CREATE AD
            // -------------------------
            $ad = Ads::create([
                'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'user_id' => $userId,
                'created_by_staff_id' => $adData['created_by_staff_id'] ?? null,
                'title' => $adData['title'] ?? null,
                'price' => $adData['price'] ?? null,
                'description' => $adData['description'] ?? null,
                'mainImage' => $adData['main_image'] ?? null,
                'subImage' => json_encode($adData['sub_images'] ?? []),
                'brand' => $brand,
                'model' => $model,
                'price_type' => $adData['pricing_type'] ?? null,
                'post_type' => $adData['post_type'] ?? null,
                'condition' => $adData['condition'] ?? null,
                'ads_package' => $adData['boosting_option'] ?? '0',
                'package_type' => $adData['package_type'] ?? null,
                'package_expire_at' => $packageExpireAt,
                'cat_id' => $adData['cat_id'] ?? null,
                'sub_cat_id' => $adData['sub_cat_id'] ?? null,
                'location' => $adData['location'] ?? null,
                'sublocation' => $adData['sublocation'] ?? null,
                'status' => '0',
                'experience_years' => $adData['experience_years'] ?? null,
                'education' => $adData['education'] ?? null,
                'application_deadline' => $adData['application_deadline'] ?? null,
                'mobile_number' => $adData['mobile_number'] ?? null,
                'rotation_position' => -1,
                'last_rotated_at' => now(),
                'voucher_amount_used' => $voucherUsed,
                'ads_count_used' => $voucherUsed > 0 ? 1 : 0,
            ]);

            // Save dynamic form fields
            $formFields = FormField::all();
            foreach ($formFields as $field) {
                $inputName = 'field_' . $field->id;
                $fieldValue = $adData[$inputName] ?? null;

                if (!is_null($fieldValue) && $fieldValue !== '') {
                    AdDetail::create([
                        'adsId' => $ad->adsId,
                        'additional_info' => $field->field_name,
                        'value' => $fieldValue
                    ]);
                }
            }

            Log::info('Ad created successfully via freeComplete', [
                'ad_id' => $ad->adsId,
                'user_id' => $userId,
                'invoice_id' => $invoiceId
            ]);

            // Notify user
            $user = User::find($userId);
            if ($user && (!$adData['created_by_staff_id'] || $user->roles !== 'staff')) {
                OtpService::sendSingleSms($user->phone_number, "Your ad has been successfully submitted! It will go live after admin approval. Thank you for using our platform.");
            }

            // Push notification
            if (isset($this->pusherService)) {
                $this->pusherService->sendNewAdNotification(
                    $ad,
                    $userId,
                    $adData['cat_id'] ?? null,
                    $adData['location'] ?? null
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'Ad created successfully',
                'ad_id' => $ad->adsId
            ]);
        } catch (\Exception $e) {
            Log::error("Free payment completion error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'invoice_id' => $invoiceId ?? null
            ]);
            return response()->json(['success' => false, 'message' => 'Server error occurred while creating ad']);
        }
    }

    public function complete(Request $request)
    {
        try {
            echo "Step 1: Entered complete() method<br>";

            $invoiceId = $request->query('invId');
            echo "Step 2: Invoice ID = {$invoiceId}<br>";

            $paymentInfo = PaymentInfo::where('invoice_id', $invoiceId)->first();
            echo "Step 3: PaymentInfo = " . json_encode($paymentInfo) . "<br>";

            if (!$paymentInfo) {
                echo "Step 4: PaymentInfo not found<br>";
                return view('newFrontend.user.payment-error')->with('error', 'Invalid payment reference.');
            }

            // Payment still pending
            if ($paymentInfo->payment_status == 0) {
                echo "Step 5: Payment status = Pending<br>";
                return view('newFrontend.user.payment-confirming');
            }

            // Payment successful
            if ($paymentInfo->payment_status == 1 || strtoupper($paymentInfo->status) === 'SUCCESS') {
                echo "Step 6: Payment status = Successful<br>";

                if ($paymentInfo->payment_for === 'membership') {
                    echo "Step 7: Payment is for membership<br>";

                    $data = json_decode($paymentInfo->ad_data, true);
                    echo "Step 8: Decoded membership data = " . json_encode($data) . "<br>";

                    $alreadyExists = MembershipPackage::where('user_id', $paymentInfo->user_id)
                        ->where('expiry_date', '>', now())
                        ->exists();
                    echo "Step 9: Membership already exists? " . ($alreadyExists ? 'Yes' : 'No') . "<br>";

                    if (!$alreadyExists) {
                        MembershipPackage::create([
                            'user_id' => $paymentInfo->user_id,
                            'start_date' => now(),
                            'expiry_date' => now()->addMonths($data['valid_month']),
                            'ads_per_month' => $data['ads_per_month'],
                            'voucher_code' => strtoupper(Str::random(6)),
                            'price' => $data['price'],
                            'promotion_voucher_cost' => $data['promotion_voucher_cost'],
                            'valid_month' => $data['valid_month'],
                        ]);
                        echo "Step 10: Membership package created<br>";
                    }

                    echo "Step 11: Redirecting to membership-package route<br>";
                    return redirect()->route('membership-package')
                        ->with('success', 'Membership purchased successfully!');
                }

                echo "Step 12: Payment was for ad posting<br>";
                return redirect()->route('user.my_ads')
                    ->with('success', 'Payment successful! Your ad has been posted.');
            }

            // Payment failed
            echo "Step 13: Payment failed<br>";
            return view('newFrontend.user.payment-error');
        } catch (\Exception $e) {
            echo "Step 14: Exception occurred → " . $e->getMessage() . "<br>";
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
            if ($adData['boosting_option'] == 6) {
                Artisan::call('ads:rotate-super');
            } elseif ($adData['boosting_option'] == 3) {
                Artisan::call('ads:rotate-top');
            } elseif ($adData['boosting_option'] == 4) {
                Artisan::call('ads:rotate-urgent');
            } elseif ($adData['boosting_option'] == 5) {
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
        Log::info("Payment Status: " . $request);
        $invoiceNo = $request['invoiceNo'] ?? null;
        $statusMessage = $request['statusMessage'] ?? null;

        if ($statusMessage == 'SUCCESS') {
            $paymentInfo = PaymentInfo::where('invoice_id', $invoiceNo)->first();
            if ($paymentInfo) {

                $adData = $paymentInfo->ad_data;
                $this->saveAd($adData, $paymentInfo->invoice_id, $paymentInfo->user_id);

                $paymentInfo->payment_status = 1;
                $paymentInfo->save();
            }
        }
    }

    public function checkPayment(Request $request)
    {
        $invoiceId = $request->query('invId');

        $payment = PaymentInfo::where('invoice_id', $invoiceId)->first();

        if (!$payment) {
            return redirect()->route('membership-package')->with('error', 'Invalid invoice.');
        }

        // (Optional) call PAYable API here to confirm payment status.

        if ($payment->status === 'SUCCESS') {
            return redirect()->route('membership-package')->with('success', 'Payment successful!');
        }

        return redirect()->route('membership-package')->with('error', 'Payment failed or pending.');
    }

    public function notifyPayment(Request $request)
    {
        $invoiceId = $request->invoiceId ?? null;
        $status = $request->status ?? null;
        $checkValue = $request->checkValue ?? null;
        $amount = $request->amount ?? null;

        if (!$invoiceId || !$status) {
            return response()->json(['error' => 'Invalid notification'], 400);
        }

        // Verify checkValue
        $expected = IpgHashService::hash($amount, $invoiceId);
        if ($checkValue !== $expected) {
            Log::error("Payment hash mismatch for invoice: $invoiceId");
            return response()->json(['error' => 'Hash mismatch'], 400);
        }

        // Update DB
        $payment = PaymentInfo::where('invoice_id', $invoiceId)->first();
        if ($payment) {
            // Normalize status to numeric: 0 = pending, 1 = success, 2 = failed
            $rawStatus = strtoupper((string)$status);
            if ($rawStatus === 'SUCCESS' || $rawStatus === '1') {
                $normalized = 1;
            } elseif ($rawStatus === 'FAILED' || $rawStatus === '0' || $rawStatus === '2') {
                $normalized = 2;
            } else {
                $normalized = 0;
            }

            $payment->status = $rawStatus; // keep raw for debugging
            $payment->payment_status = $normalized;
            $payment->save();

            // Create membership only on successful payment and if payment was for membership
            if ($normalized === 1 && ($payment->payment_for ?? '') === 'membership') {
                $data = json_decode($payment->ad_data, true) ?: [];
                // check existing active package
                $already = MembershipPackage::where('user_id', $payment->user_id)
                    ->where('expiry_date', '>', now())
                    ->exists();

                if (!$already) {
                    MembershipPackage::create([
                        'user_id' => $payment->user_id,
                        'start_date' => now(),
                        'expiry_date' => now()->addMonths((int)($data['valid_month'] ?? 0)),
                        'ads_per_month' => $data['ads_per_month'] ?? 0,
                        'voucher_code' => strtoupper(Str::random(6)),
                        'price' => $data['price'] ?? 0,
                        'promotion_voucher_cost' => $data['promotion_voucher_cost'] ?? 0,
                        'valid_month' => $data['valid_month'] ?? 0,
                        'business_name' => $data['business_name'] ?? null,
                        'business_email' => $data['business_email'] ?? null,
                        'business_phone' => $data['business_phone'] ?? null,
                    ]);
                }
            }
        }

        return response()->json(['message' => 'Payment recorded']);
    }
}
