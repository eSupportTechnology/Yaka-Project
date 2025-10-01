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
        $membershipData = session('membership_data');
        $adData = session('ad_data');
        $paymentFor = session('payment_for');

        if ($membershipData && $paymentFor === 'membership') {
            return $this->showMembershipPayment();
        }

        return $this->showAdPayment();
    }

    private function getPaymentType($invoiceId)
    {
        if (str_starts_with($invoiceId, 'YKMB')) {
            return 'membership';
        }
        return 'ad';
    }
    private function showAdPayment()
    {
        $packageId = session('package_id');
        $packageType = session('package_type');
        $selectedPackageName = session('selected_package_name');
        $selectedPackagePrice = session('selected_package_price');
        $selectedPackageDuration = session('selected_package_duration');
        $adData = session('ad_data');

        $invoiceId = "YKAD" . date('YmdHis');
        $checkValue = IpgHashService::hash($selectedPackagePrice, $invoiceId);

        PaymentInfo::create([
            'check_value' => $checkValue,
            'invoice_id' => $invoiceId,
            'ad_data' => json_encode($adData),
            'user_id' => auth()->id(),
        ]);

        session(['checkValue' => $checkValue]);
        session(['invoiceId' => $invoiceId]);

        $activeMembership = MembershipPackage::where('user_id', auth()->id())
            ->where('expiry_date', '>', now())
            ->where('promotion_voucher_cost', '>', 0)
            ->first();

        return view('newFrontend.user.payment', compact(
            'selectedPackageName',
            'selectedPackageDuration',
            'selectedPackagePrice',
            'packageType',
            'adData',
            'checkValue',
            'invoiceId',
            'activeMembership'
        ))->with('paymentType', 'ad');
    }

    private function showMembershipPayment()
    {
        $membershipData = session('membership_data');

        if (!$membershipData) {
            return redirect()->route('membership-package')
                ->with('error', 'Invalid session. Please try again.');
        }

        $price = (float) $membershipData['price'];
        $invoiceId = session('invoiceId', "YKMB" . now()->format('ymdHis'));
        $checkValue = session('checkValue');

        if (!$checkValue) {
            $checkValue = IpgHashService::hash($price, $invoiceId);

            PaymentInfo::create([
                'check_value' => $checkValue,
                'invoice_id'  => $invoiceId,
                'user_id'     => auth()->id(),
                'ad_data'     => json_encode($membershipData),
            ]);

            session(['checkValue' => $checkValue]);
            session(['invoiceId' => $invoiceId]);
        }

        return view('newFrontend.user.payment', [
            'selectedPackageName' => 'Membership Package',
            'selectedPackageDuration' => $membershipData['valid_month'] . ' month(s)',
            'selectedPackagePrice' => $price,
            'packageType' => null,
            'adData' => null,
            'checkValue' => $checkValue,
            'invoiceId' => $invoiceId,
            'activeMembership' => null,
            'paymentType' => 'membership',
            'membershipData' => $membershipData
        ]);
    }

    public function freeComplete(Request $request)
    {
        try {
            $invoiceId = $request->input('invoiceId');
            $rawAdData = $request->input('adData');

            if (is_string($rawAdData)) {
                $adData = json_decode($rawAdData, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning('freeComplete: adData JSON decode failed', [
                        'invoice_id' => $invoiceId,
                        'json_error' => json_last_error_msg(),
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

            $paymentType = $this->getPaymentType($invoiceId);

            if ($paymentType === 'membership') {
                return $this->completeMembershipPurchase($payment);
            }

            return $this->completeAdPosting($payment, $adData);

        } catch (\Exception $e) {
            Log::error("Free payment completion error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'invoice_id' => $invoiceId ?? null
            ]);
            return response()->json(['success' => false, 'message' => 'Server error occurred']);
        }
    }


    private function completeAdPosting($payment, $adData)
    {
        $payment->payment_status = 1;
        $payment->save();

        $userId = $adData['user_id'] ?? null;
        $voucherRequested = isset($adData['voucher_amount']) ? (float) $adData['voucher_amount'] : 0.0;
        $selectedPackagePrice = isset($adData['selected_package_price'])
            ? (float) $adData['selected_package_price']
            : (float) ($adData['price'] ?? 0.0);

        $membershipPackage = null;
        if (!empty($adData['membership_package_id'])) {
            $membershipPackage = MembershipPackage::find($adData['membership_package_id']);
        } elseif (!empty($userId)) {
            $membershipPackage = MembershipPackage::where('user_id', $userId)
                ->where('expiry_date', '>', now())
                ->latest()
                ->first();
        }

        $voucherUsed = 0;
        if ($voucherRequested > 0 && $membershipPackage) {
            $availableVoucher = (float) ($membershipPackage->promotion_voucher_cost ?? 0.0);
            $voucherUsed = min($voucherRequested, $availableVoucher, $selectedPackagePrice);

            if ($voucherUsed > 0) {
                $membershipPackage->promotion_voucher_cost = max(0, $availableVoucher - $voucherUsed);
                $membershipPackage->save();
            }

            Log::info('Voucher deducted', [
                'membership_id' => $membershipPackage->id,
                'voucher_used' => $voucherUsed,
                'remaining' => $membershipPackage->promotion_voucher_cost
            ]);
        }

        $currentYear = now()->year;
        $currentMonth = now()->month;

        if ($membershipPackage) {
            if ($membershipPackage->expiry_date && $membershipPackage->expiry_date < now()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your package has expired. Please renew to post more ads.'
                ]);
            }

            $usage = MembershipAdUsage::firstOrCreate(
                [
                    'membership_package_id' => $membershipPackage->id,
                    'user_id' => $userId,
                    'year' => $currentYear,
                    'month' => $currentMonth,
                ],
                ['ads_used' => 0]
            );

            if ($usage->ads_used >= $membershipPackage->ads_per_month) {
                return response()->json([
                    'success' => false,
                    'message' => 'Monthly ad limit reached. Please wait until next month.'
                ]);
            }

            $usage->increment('ads_used');
        }

        $packageExpireAt = null;
        if (isset($adData['boosting_option']) && $adData['boosting_option'] != '0') {
            $packageType = PackageType::find($adData['package_type'] ?? null);
            if ($packageType) {
                $packageExpireAt = Carbon::now()->addDays((int) $packageType->duration);
            }
        } else {
            $packageExpireAt = Carbon::now()->addDays(30);
        }

        $ad = Ads::create([
            'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
            'user_id' => $userId,
            'created_by_staff_id' => $adData['created_by_staff_id'] ?? null,
            'title' => $adData['title'] ?? null,
            'price' => $adData['price'] ?? null,
            'description' => $adData['description'] ?? null,
            'mainImage' => $adData['main_image'] ?? null,
            'subImage' => json_encode($adData['sub_images'] ?? []),
            'brand' => $adData['brand'] ?? 'no brand',
            'model' => $adData['model'] ?? 'no model',
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

        $user = User::find($userId);
        if ($user && (!$adData['created_by_staff_id'] || $user->roles !== 'staff')) {
            OtpService::sendSingleSms($user->phone_number, "Your ad has been successfully submitted! It will go live after admin approval.");
        }

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
    }


    private function completeMembershipPurchase($payment)
    {
        $payment->payment_status = 1;
        $payment->save();

        $data = json_decode($payment->ad_data, true);

        $alreadyExists = MembershipPackage::where('user_id', $payment->user_id)
            ->where('expiry_date', '>', now())
            ->exists();

        if (!$alreadyExists) {
            MembershipPackage::create([
                'user_id' => $payment->user_id,
                'start_date' => now(),
                'expiry_date' => now()->addMonths($data['valid_month']),
                'ads_per_month' => $data['ads_per_month'],
                'voucher_code' => strtoupper(Str::random(6)),
                'price' => $data['price'],
                'promotion_voucher_cost' => $data['promotion_voucher_cost'],
                'valid_month' => $data['valid_month'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Membership purchased successfully',
            'redirect' => route('membership-package')
        ]);
    }


    public function complete(Request $request)
    {
        try {
            $invoiceId = $request->query('invId');
            $paymentInfo = PaymentInfo::where('invoice_id', $invoiceId)->first();

            if (!$paymentInfo) {
                return view('newFrontend.user.payment-error')->with('error', 'Invalid payment reference.');
            }

            if ($paymentInfo->payment_status == 0) {
                return view('newFrontend.user.payment-confirming');
            }

            if ($paymentInfo->payment_status == 1) {
                $paymentType = $this->getPaymentType($invoiceId);

                if ($paymentType === 'membership') {
                    return redirect()->route('membership-package')
                        ->with('success', 'Membership purchased successfully!');
                }

                return redirect()->route('user.my_ads')
                    ->with('success', 'Payment successful! Your ad has been posted.');
            }

            return view('newFrontend.user.payment-error');

        } catch (\Exception $e) {
            Log::error('Payment processing error', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        }
    }

    public function getPaymentInfo(Request $request)
    {
        Log::info("Payment callback received", $request->all());

        $invoiceNo = $request['invoiceNo'] ?? null;
        $statusMessage = $request['statusMessage'] ?? null;

        if ($statusMessage == 'SUCCESS') {
            $paymentInfo = PaymentInfo::where('invoice_id', $invoiceNo)->first();

            if ($paymentInfo && $paymentInfo->payment_status == 0) {
                $paymentInfo->payment_status = 1;
                $paymentInfo->save();

                $paymentType = $this->getPaymentType($invoiceNo);

                if ($paymentType === 'ad') {
                    $adData = json_decode($paymentInfo->ad_data, true);
                    $this->saveAd($adData, $paymentInfo->invoice_id, $paymentInfo->user_id);
                }
            }
        }
    }


    private function saveAd($adData, $invoiceId, $userId)
    {
        try {
            $packageExpireAt = null;
            if (($adData['boosting_option'] ?? '0') != '0') {
                $packageType = PackageType::find($adData['package_type'] ?? null);
                if ($packageType) {
                    $packageExpireAt = now()->addDays((int)$packageType->duration);
                }
            }

            $user = User::find($userId);

            $boostOption = $adData['boosting_option'] ?? '0';
            if ($boostOption == 6) {
                Artisan::call('ads:rotate-super');
            } elseif ($boostOption == 3) {
                Artisan::call('ads:rotate-top');
            } elseif ($boostOption == 4) {
                Artisan::call('ads:rotate-urgent');
            } elseif ($boostOption == 5) {
                Artisan::call('ads:rotate-jump');
            }

            Ads::create([
                'adsId' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'invoice_id' => $invoiceId,
                'user_id' => $userId,
                'title' => $adData['title'] ?? null,
                'price' => $adData['price'] ?? null,
                'description' => $adData['description'] ?? null,
                'mainImage' => $adData['main_image'] ?? null,
                'subImage' => json_encode($adData['sub_images'] ?? []),
                'brand' => $adData['brand'] ?? 'N/A',
                'model' => $adData['model'] ?? 'N/A',
                'price_type' => $adData['pricing_type'] ?? null,
                'post_type' => $adData['post_type'] ?? null,
                'condition' => $adData['condition'] ?? null,
                'ads_package' => $boostOption,
                'package_type' => $adData['package_type'] ?? null,
                'package_expire_at' => $packageExpireAt,
                'cat_id' => $adData['cat_id'] ?? null,
                'sub_cat_id' => $adData['sub_cat_id'] ?? null,
                'location' => $adData['location'] ?? null,
                'sublocation' => $adData['sublocation'] ?? null,
                'rotation_position' => -1,
                'last_rotated_at' => now(),
                'status' => '0',
            ]);

            if ($user) {
                OtpService::sendSingleSms($user->phone_number, "Payment received. Your ad will be published after admin approval. Thank you!");
            }

            Log::info('Ad saved successfully via gateway callback', ['invoice_id' => $invoiceId]);

        } catch (\Exception $e) {
            Log::error('Error saving ad', ['error' => $e->getMessage()]);
        }
    }
}
