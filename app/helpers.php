<?php

if (!function_exists('storage_public_url')) {
    function storage_public_url($path)
    {
        if(env('APP_ENV') == 'local') {
            return asset('storage/' . ltrim($path, '/'));
        } else {
            return asset('public/storage/' . ltrim($path, '/'));
        }
    }
}
