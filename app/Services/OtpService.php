<?php


namespace App\Services;


class OtpService
{
    public static function sendSingleSms($receiver, $message) {

        $payload = [
            "senderID" => "YAKA.LK",
            "to" => $receiver,
            "msg" => $message
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('quick-send.single-sms-url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic '.config('quick-send.auth-key')
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        if($response['status'] == 'success') {
            return true;
        }
        return false;
    }
}
