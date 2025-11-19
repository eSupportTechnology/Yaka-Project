<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function paymentPage(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'price' => 'required|numeric',
            'promotion_voucher_cost' => 'required|numeric',
            'ads_per_month' => 'required|integer',
            'valid_month' => 'required|integer',
            'business_name' => 'required|string',
            'business_email' => 'required|email',
            'business_phone' => 'required|string',
        ]);

        $user = Auth::user();

        // Generate unique order ID
        $orderId = 'ORD-' . time() . '-' . $user->id;

        // Store order in session for later verification
        session([
            'pending_order' => [
                'order_id' => $orderId,
                'user_id' => $user->id,
                'price' => $request->price,
                'promotion_voucher_cost' => $request->promotion_voucher_cost,
                'ads_per_month' => $request->ads_per_month,
                'valid_month' => $request->valid_month,
                'business_name' => $request->business_name,
                'business_email' => $request->business_email,
                'business_phone' => $request->business_phone,
                'created_at' => now()
            ]
        ]);

        // Payment gateway configuration
        $merchantKey = env('MERCHANT_KEY');
        $merchantToken = env('MERCHANT_TOKEN');
        $notifyUrl = env('NOTIFY_URL');
        $returnUrl = route('payment.return');
        $cancelUrl = route('payment.cancel');

        // Prepare payment data
        $amount = number_format($request->price, 2, '.', '');

        // Generate hash for security
        $hashData = $merchantKey . $orderId . $amount . 'LKR';
        $hash = strtoupper(hash_hmac('sha256', $hashData, $merchantToken));

        $paymentData = [
            'merchant_key' => $merchantKey,
            'order_id' => $orderId,
            'amount' => $amount,
            'currency' => 'LKR',
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone_number,
            'address' => $user->address ?? '',
            'city' => $user->city ?? '',
            'country' => 'Sri Lanka',
            'return_url' => $returnUrl,
            'cancel_url' => $cancelUrl,
            'notify_url' => $notifyUrl,
            'hash' => $hash,
            'items' => $request->business_name . ' Membership (' . $request->valid_month . ' months)',
            'custom_1' => $request->business_name,
            'custom_2' => $request->business_email,
            'custom_3' => $request->business_phone,
        ];

        return view('payment.gateway', compact('paymentData'));
    }

    public function paymentNotify(Request $request)
    {
        // Log the notification for debugging
        Log::info('Payment Notification Received:', $request->all());

        try {
            $merchantKey = env('MERCHANT_KEY');
            $merchantToken = env('MERCHANT_TOKEN');

            // Verify the hash
            $receivedHash = $request->hash;
            $orderId = $request->order_id;
            $amount = $request->amount;
            $status = $request->status;

            $hashData = $merchantKey . $orderId . $amount . 'LKR' . $status;
            $calculatedHash = strtoupper(hash_hmac('sha256', $hashData, $merchantToken));

            if ($receivedHash !== $calculatedHash) {
                Log::error('Hash verification failed for order: ' . $orderId);
                return response()->json(['status' => 'error', 'message' => 'Invalid hash'], 400);
            }

            // Check payment status
            if ($status == 2 || strtolower($status) == 'success') {
                // Payment successful - Create membership record
                $orderData = session('pending_order');

                if (!$orderData || $orderData['order_id'] !== $orderId) {
                    Log::error('Order data not found in session for: ' . $orderId);
                    return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
                }

                // Generate voucher code
                $voucherCode = 'VC-' . strtoupper(substr(md5($orderId . time()), 0, 10));

                // Calculate start and expiry dates
                $startDate = Carbon::now();
                $expiryDate = Carbon::now()->addMonths($orderData['valid_month']);

                // Insert membership into database
                DB::table('user_memberships')->insert([
                    'user_id' => $orderData['user_id'],
                    'valid_month' => $orderData['valid_month'],
                    'price' => $orderData['price'],
                    'ads_per_month' => $orderData['ads_per_month'],
                    'promotion_voucher_cost' => $orderData['promotion_voucher_cost'],
                    'start_date' => $startDate,
                    'expiry_date' => $expiryDate,
                    'voucher_code' => $voucherCode,
                    'business_name' => $orderData['business_name'],
                    'business_email' => $orderData['business_email'],
                    'business_phone' => $orderData['business_phone'],
                    'order_id' => $orderId,
                    'payment_status' => 'paid',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Clear session
                session()->forget('pending_order');

                Log::info('Membership created successfully for order: ' . $orderId);

                return response()->json(['status' => 'success', 'message' => 'Payment processed successfully']);
            } else {
                Log::warning('Payment failed for order: ' . $orderId . ' with status: ' . $status);
                return response()->json(['status' => 'failed', 'message' => 'Payment not successful'], 200);
            }
        } catch (\Exception $e) {
            Log::error('Payment notification error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Server error'], 500);
        }
    }

    public function paymentReturn(Request $request)
    {
        $status = $request->status ?? $request->payment_status;
        $orderId = $request->order_id;

        if ($status == 2 || strtolower($status) == 'success') {
            return redirect()->route('membership-package')
                ->with('success', 'Payment successful! Your membership has been activated. Order ID: ' . $orderId);
        } else {
            return redirect()->route('membership-package')
                ->with('error', 'Payment failed. Please try again.');
        }
    }

    public function paymentCancel(Request $request)
    {
        return redirect()->route('membership-package')
            ->with('error', 'Payment was cancelled. You can try again anytime.');
    }
}
