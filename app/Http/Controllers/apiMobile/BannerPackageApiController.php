<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\BannerPackage;
use App\Services\ApiResponseService;

class BannerPackageApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function updateBannerPackage(Request $request, $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'status' => 'required|in:0,1',
                'no_of_days' => 'required|integer|min:1',
            ]);

            $pack = BannerPackage::find($id);
            if (!$pack) {
                return $this->apiResponse->error('Banner package not found', 'Invalid ID', 404);
            }

            $pack->name = $validated['name'];
            $pack->no_of_days = $validated['no_of_days'];
            $pack->status = $validated['status'];
            $pack->save();

            return $this->apiResponse->success($pack, 'Banner package updated successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to update banner package', 500);
        }
    }

    public function deleteBannerPackage($id): JsonResponse
    {
        try {
            $pack = BannerPackage::find($id);
            if (!$pack) {
                return $this->apiResponse->error('Banner package not found', 'Invalid ID', 404);
            }

            $pack->delete();

            return $this->apiResponse->success(null, 'Banner package deleted successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to delete banner package', 500);
        }
    }
}
