<?php

namespace App\Services;

use Pusher\Pusher;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Category;

class PusherNotificationService
{
    private $pusher;

    public function __construct()
    {
        $this->pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'useTLS' => true,
                'timeout' => 30,
                'debug' => config('app.debug', false)
            ]
        );
    }

    public function sendNewAdNotification($ad, $userId, $catId, $location)
    {
        try {
            $user = User::find($userId);
            $category = Category::find($catId);

            $notificationData = [
                'type' => 'new_ad_created',
                'ad_id' => $ad->adsId,
                'title' => $ad->title,
                'price' => $ad->price,
                'description' => $this->truncateText($ad->description, 100),
                'main_image' => asset('storage/' . $ad->mainImage),
                'category' => [
                    'id' => $catId,
                    'name' => $category ? $category->name : 'Unknown'
                ],
                'location' => $location,
                'brand' => $ad->brand,
                'model' => $ad->model,
                'condition' => $ad->condition,
                'post_type' => $ad->post_type,
                'price_type' => $ad->price_type,
                'user' => [
                    'id' => $user->id,
                    'name' => trim($user->first_name . ' ' . $user->last_name),
                    'phone' => $user->phone_number
                ],
                'created_at' => $ad->created_at->toISOString(),
                'timestamp' => now()->timestamp,
                'status' => $ad->status
            ];

            $channels = [
                'new-ads',
                'category-' . $catId,
                'location-' . $this->formatChannelName($location),
                'new-ads-' . date('Y-m-d')
            ];

            foreach ($channels as $channel) {
                $this->pusher->trigger($channel, 'ad.created', $notificationData);
            }

            Log::info('Pusher notification sent successfully', [
                'ad_id' => $ad->adsId,
                'channels' => $channels,
                'user_id' => $userId
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to send Pusher notification', [
                'error' => $e->getMessage(),
                'ad_id' => $ad->adsId ?? 'unknown',
                'user_id' => $userId
            ]);
            return false;
        }
    }

    private function formatChannelName($name)
    {
        return strtolower(str_replace([' ', '&', ',', '/', '\\'], '-', $name));
    }

    private function truncateText($text, $length = 100)
    {
        return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
    }
}
