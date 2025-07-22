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
    public function packageCreate(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:table_package,name',
                'status' => 'required|in:0,1',
                'mainid' => 'nullable|integer|exists:table_package,id',
            ]);

            $url = strtolower($validated['name']);
            $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
            $url = preg_replace('/\s+/', '-', $url);

            $package = new Package();
            $package->name = $validated['name'];
            $package->url = $url;
            $package->status = $validated['status'];

            if (isset($validated['mainid'])) {
                $package->mainId = $validated['mainid'];
            }

            $package->save();

            return $this->apiResponse->success($package, 'Package created successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to create package', 500);
        }
    }
}
