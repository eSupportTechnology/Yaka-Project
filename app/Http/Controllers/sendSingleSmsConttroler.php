<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class sendSingleSmsConttroler extends Controller
{
    public function sendSingleSms(Request $request){
        $url = 'https://quicksend.lk/Client/api.php?FUN=SEND_SINGLE';

        // Headers with Basic Auth encoded in Base64
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic dHBub3ZhdGl0YW5AZ21haWwuY29tOjE5OTYzMjgyODY3MWRhYzZjODRiYjU2NDE3MjY0OTg='
        ];
    
        // Data to be sent in the request
        $data = [
            "senderID" => "QKSendDemo",
            "to" => "0762005399",
            "msg" => "A Test Message"
        ];
    
        // Send POST request
        $response = Http::withHeaders($headers)->post($url, $data);
    
        // Check for errors or success response
        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'message' => 'SMS sent successfully',
                'data' => $response->json()
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send SMS',
                'error' => $response->json()
            ], $response->status());
        }
    }
}
