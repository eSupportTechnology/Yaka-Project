<?php

return [
    'logo-url' => env('IPG_LOGO_URL', '0'),
    'merchant-key' => env('MERCHANT_KEY', '0'),
    'merchant-token' => env('MERCHANT_TOKEN', '0'),
    'notify-url' => env('NOTIFY_URL', '0'),
    'notify-boost-url' => env('APP_URL') . env('NOTIFY_BOOST_PATH', '/api/payment/boostnotify'),
];
