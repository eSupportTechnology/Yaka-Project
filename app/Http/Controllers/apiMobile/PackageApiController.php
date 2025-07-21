<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Package;
use App\Services\ApiResponseService;

class PackageApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function packageUpdate(Request $request, $url): JsonResponse
    {
        try {
            $pack = Package::where('url', $url)->first();

            if (!$pack) {
                return $this->apiResponse->error('Package not found', 'No package found with the given URL', 404);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'status' => 'required|in:0,1'
            ]);

            $generatedUrl = strtolower($validated['name']);
            $generatedUrl = preg_replace('/[^a-z0-9\-]/', ' ', $generatedUrl);
            $generatedUrl = preg_replace('/\s+/', '-', $generatedUrl);

            $pack->name = $validated['name'];
            $pack->status = $validated['status'];
            $pack->url = $generatedUrl;

            $pack->save();

            return $this->apiResponse->success($pack, 'Package updated successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to update package', 500);
        }
    }

    public function packageDelete($url): JsonResponse
    {
        try {
            $pack = Package::where('url', $url)->first();

            if (!$pack) {
                return $this->apiResponse->error('Package not found', 'No package found with the given URL', 404);
            }

            $pack->delete();

            return $this->apiResponse->success(null, 'Package deleted successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to delete package', 500);
        }
    }
}
