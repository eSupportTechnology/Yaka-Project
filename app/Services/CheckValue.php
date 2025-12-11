<?php


namespace App\Services;

use Illuminate\Support\Facades\Log;

class CheckValue
{
    public static function hash($amount, $invoiceId, $payableOrderId, $payableTransactionId, $statusCode) {
        $merchantKey = config('ipg.merchant-key');
        $payableOrderId = $payableOrderId;
        $payableTransactionId = $payableTransactionId;
        $amount = $amount;
        $currencyCode = 'LKR';
        $invoiceId = $invoiceId;
        $statusCode = $statusCode;
        $merchantToken = config('ipg.merchant-token');

       Log::info('Payment hash', [
                'amount' => $amount,

            ]);

        // Step 1: Generate SHA512 of merchantToken and convert to uppercase
        $hashedToken = strtoupper(hash('sha512', $merchantToken));

        // Step 2: Concatenate values with pipe "|"
        $rawString = $merchantKey . '|' .$payableOrderId . '|' . $payableTransactionId . '|' . $amount . '|' . $currencyCode . '|' . $invoiceId . '|' . $statusCode . '|' . $hashedToken;

        // Step 3: Hash the full string with SHA512 and convert to uppercase
        $finalCheckValue = strtoupper(hash('sha512', $rawString));

        return $finalCheckValue;
    }
}
