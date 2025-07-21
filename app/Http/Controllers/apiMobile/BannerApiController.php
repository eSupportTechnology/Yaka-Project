<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banners;
use Illuminate\Http\JsonResponse;
use App\Services\ApiResponseService;

class BannerApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function updateBanner(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'type' => 'required|in:0,1',
            ]);

            $banner = Banners::findOrFail($id);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('banners'), $imageName);

                $oldPath = public_path('banners/' . $banner->img);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }

                $banner->img = $imageName;
            }

            $banner->type = $request->input('type');
            $banner->save();

            return $this->apiResponse->success($banner, 'Banner updated successfully!');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to update banner', 500);
        }
    }

    public function deleteBanner($id): JsonResponse
    {
        try {
            $banner = Banners::findOrFail($id);

            $imgPath = public_path('banners/' . $banner->img);
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }

            $banner->delete();

            return $this->apiResponse->success(null, 'Banner deleted successfully!');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to delete banner', 500);
        }
    }
}
