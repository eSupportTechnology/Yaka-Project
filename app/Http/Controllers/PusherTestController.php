<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PusherNotificationService;
use App\Models\Ads;

class PusherTestController extends Controller
{
    private $pusherService;

    public function __construct(PusherNotificationService $pusherService)
    {
        $this->pusherService = $pusherService;
    }

    public function testConnection()
    {
        try {
            $pusher = new \Pusher\Pusher(
                config('broadcasting.connections.pusher.key'),
                config('broadcasting.connections.pusher.secret'),
                config('broadcasting.connections.pusher.app_id'),
                [
                    'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                    'useTLS' => true
                ]
            );

            $result = $pusher->trigger('test-channel', 'test-event', [
                'message' => 'Hello from Laravel!',
                'timestamp' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pusher test successful',
                'result' => $result
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pusher test failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function simulateNewAd()
    {
        try {
            $ad = Ads::first();
            if (!$ad) {
                return response()->json([
                    'success' => false,
                    'message' => 'No ads found to test with'
                ], 404);
            }

            $result = $this->pusherService->sendNewAdNotification(
                $ad,
                $ad->user_id,
                $ad->cat_id,
                $ad->location
            );

            return response()->json([
                'success' => $result,
                'message' => $result ? 'Test notification sent' : 'Failed to send notification',
                'ad_id' => $ad->adsId
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Test failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
