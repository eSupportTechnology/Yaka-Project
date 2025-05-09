<?php


namespace App\Services;


class IpgHashService
{
    public static function hash($amount, $invoiceId) {
        $merchantKey = config('ipg.merchant-key');
        $invoiceId = $invoiceId;
        $amount = $amount;
        $currencyCode = 'LKR';
        $merchantToken = config('ipg.merchant-token');

        // Step 1: Generate SHA512 of merchantToken and convert to uppercase
        $hashedToken = strtoupper(hash('sha512', $merchantToken));

        // Step 2: Concatenate values with pipe "|"
        $rawString = $merchantKey . '|' . $invoiceId . '|' . $amount . '|' . $currencyCode . '|' . $hashedToken;

        // Step 3: Hash the full string with SHA512 and convert to uppercase
        $finalCheckValue = strtoupper(hash('sha512', $rawString));

        return $finalCheckValue;
    }
}
