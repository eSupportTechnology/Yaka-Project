<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ads;
use App\Services\ApiResponseService;

class StaffApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function staffGetStaffId($id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->apiResponse->error('Staff not found', 'No staff found with the given ID', 404);
            }

            $userAds = Ads::where('created_by_staff_id', $id)->get();
            $totalAds = $userAds->count();

            $adsDetails = DB::select("
                SELECT a.cat_id, COUNT(1) AS total, c.name
                FROM ads a
                JOIN categories c ON c.id = a.cat_id
                WHERE a.created_by_staff_id = ?
                GROUP BY a.cat_id, c.name
                ORDER BY a.cat_id ASC
            ", [$id]);

            return $this->apiResponse->success([
                'staff' => $user,
                'total_ads' => $totalAds,
                'ads_by_category' => $adsDetails
            ], 'Staff details fetched successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch staff details', 500);
        }
    }
}
