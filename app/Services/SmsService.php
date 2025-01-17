<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    protected $url;
    protected $headers;

    public function __construct()
    {
        $this->url = 'https://quicksend.lk/Client/api.php?FUN=SEND_SINGLE';
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic dHBub3ZhdGl0YW5AZ21haWwuY29tOjE5OTYzMjgyODY3MWRhYzZjODRiYjU2NDE3MjY0OTg=' // Replace with your actual credentials
        ];
    }

    public function sendSingleSms($senderID, $to, $message)
    {
        $data = [
            "senderID" => $senderID,
            "to" => $to,
            "msg" => $message
        ];

        $response = Http::withHeaders($this->headers)->post($this->url, $data);

        if ($response->successful()) {
            return [
                'status' => 'success',
                'data' => $response->json()
            ];
        }

        return [
            'status' => 'error',
            'error' => $response->json()
        ];
    }
}
