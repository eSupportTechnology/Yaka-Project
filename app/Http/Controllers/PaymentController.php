<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function paymentNotify(Request $request)
    {
        // Capture the incoming JSON data from the request
        $data = $request->json()->all();

        // Log the received payment data for debugging purposes
        Log::info('payment received:', $data);

        // Store the payment data in the database
        $this->paymentstore($data);
    }

    // Store the payment data in the database
    public function paymentstore($data)
    {
      $ad = Ads::where('adsId', $data['invoiceNo'])->first();
     
        try {
            // Convert the incoming data into the format required by the database
            Payment::create([
                'user_id' => $ad->user_id,
                'ad_id' => $data['invoiceNo'] ?? null,
                'invoiceNo' => $data['invoiceNo'] ?? null,
                'payableAmount' => $data['payableAmount'] ?? null,
                'payableCurrency' => $data['payableCurrency'] ?? null,
                'statusMessage' => $data['statusMessage'] ?? null,
                'paymentType' => $data['paymentType'] ?? null,
                'paymentScheme' => $data['paymentScheme'] ?? null,
                'cardHolderName' => $data['cardHolderName'] ?? null,
                'cardNumber' => $data['cardNumber'] ?? null,
                'paymentId' => $data['paymentId'] ?? null,
                'checkValue' => $data['checkValue'] ?? null,
            ]);

            $ad->status = 1;
            $ad->save();

            // Log success message
            Log::info('Payment successfully stored in the database');
        } catch (\Exception $e) {
            // Log error in case of failure
            Log::error('Error storing payment: ' . $e->getMessage());
        }
    }
}
