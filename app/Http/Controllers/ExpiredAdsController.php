<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\AdDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ExpiredAdsController extends Controller
{
    public function deleteExpiredAds(Request $request)
    {
        try {
            $today = Carbon::now();
            Log::info('Starting expired ads cleanup', ['current_date' => $today]);

            $expiredAds = Ads::where('package_expire_at', '<', $today)->get();

            if ($expiredAds->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No expired ads found',
                    'deleted_count' => 0
                ]);
            }

            $deletedCount = 0;
            $deletedImages = [];
            $errors = [];

            DB::beginTransaction();

            foreach ($expiredAds as $ad) {
                try {
                    // Collect images before deleting ad
                    $imagesToDelete = [];

                    if ($ad->mainImage) {
                        $imagesToDelete[] = $ad->mainImage;
                    }
                    if ($ad->subImage) {
                        $subImages = json_decode($ad->subImage, true);
                        if (is_array($subImages)) {
                            $imagesToDelete = array_merge($imagesToDelete, $subImages);
                        }
                    }

                    // Delete ad details
                    if (Schema::hasTable('ad_details') && Schema::hasColumn('ad_details', 'adsId')) {
                        DB::table('ad_details')->where('adsId', $ad->adsId)->delete();
                    } else {
                        Log::warning("Table ad_details or column adsId does not exist; skipped deletion for adId {$ad->adsId}");
                    }

                    // Delete from other related tables if column exists
                    $relatedTables = [
                        'electronic_devices',
                        'vehicles',
                        'properties',
                        'animals',
                        'home_and_gardens',
                        'services',
                        'other_ads',
                        'business_and_industries',
                        'hobby_sports_and_kids',
                        'fashion_and_beauties',
                        'essentials',
                        'educations',
                        'agricultures',
                        'jobs',
                    ];

                    foreach ($relatedTables as $table) {
                        if (Schema::hasTable($table) && Schema::hasColumn($table, 'adsId')) {
                            DB::table($table)->where('adsId', $ad->adsId)->delete();
                        } else {
                            Log::warning("Table {$table} or column adsId does not exist; skipped deletion for adId {$ad->adsId}");
                        }
                    }

                    // Delete the ad record itself
                    $ad->delete();

                    // Delete all collected images from storage
                    foreach ($imagesToDelete as $imagePath) {
                        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                            Storage::disk('public')->delete($imagePath);
                            $deletedImages[] = $imagePath;
                        }
                    }

                    $deletedCount++;

                    Log::info('Deleted expired ad with images', [
                        'ad_id' => $ad->adsId,
                        'expired_at' => $ad->package_expire_at,
                        'images_deleted' => $imagesToDelete
                    ]);

                } catch (\Exception $e) {
                    $errors[] = [
                        'ad_id' => $ad->adsId,
                        'error' => $e->getMessage()
                    ];
                    Log::error('Error deleting expired ad', [
                        'ad_id' => $ad->adsId,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            DB::commit();

            $response = [
                'success' => true,
                'message' => "Successfully deleted {$deletedCount} expired ads",
                'deleted_count' => $deletedCount,
                'images_deleted_count' => count($deletedImages),
                'cleanup_date' => $today->toDateTimeString()
            ];

            if (!empty($errors)) {
                $response['errors'] = $errors;
                $response['message'] .= ' with ' . count($errors) . ' errors';
            }

            Log::info('Expired ads cleanup completed', $response);

            return response()->json($response);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Critical error in expired ads cleanup', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to cleanup expired ads: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get count of expired ads without deleting them
     */
    public function getExpiredAdsCount()
    {
        try {
            $today = Carbon::now();
            $expiredCount = Ads::where('package_expire_at', '<', $today)->count();

            return response()->json([
                'success' => true,
                'expired_count' => $expiredCount,
                'check_date' => $today->toDateTimeString()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get expired ads count: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get list of expired ads with details (for preview before deletion)
     */
    public function getExpiredAdsList()
    {
        try {
            $today = Carbon::now();
            $expiredAds = Ads::where('package_expire_at', '<', $today)
                ->select('adsId', 'title', 'user_id', 'package_expire_at', 'mainImage', 'subImage')
                ->with('user:id,first_name,last_name,phone_number')
                ->get();

            return response()->json([
                'success' => true,
                'expired_ads' => $expiredAds,
                'total_count' => $expiredAds->count(),
                'check_date' => $today->toDateTimeString()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get expired ads list: ' . $e->getMessage()
            ], 500);
        }
    }
}
