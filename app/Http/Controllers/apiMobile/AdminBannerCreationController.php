<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\BannerPackage;
use App\Services\ApiResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AdminBannerCreationController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Create a new banner via API
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBanner(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'type' => 'required|integer|in:0,1',
                'url' => 'nullable|url',
                'package' => 'required|exists:banner_packages,id'
            ]);

            if ($validator->fails()) {
                return $this->apiResponse->error(
                    $validator->errors(),
                    'Validation failed',
                    422
                );
            }

            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Get image dimensions
                list($width, $height) = getimagesize($image);

                // Validate based on the selected type
                if ($request->input('type') == 0) { // Leaderboard
                    if ($width != 1140 || $height != 180) {
                        return $this->apiResponse->error(
                            ['image' => 'Leaderboard banner size must be 1140x180 pixels'],
                            'Invalid image dimensions',
                            422
                        );
                    }
                } elseif ($request->input('type') == 1) { // Skyscraper
                    if ($width != 285 || $height != 500) {
                        return $this->apiResponse->error(
                            ['image' => 'Skyscraper banner size must be 285x500 pixels'],
                            'Invalid image dimensions',
                            422
                        );
                    }
                }

                // Save the image in the 'public/banners' folder
                $image->move(public_path('banners'), $imageName);

                // Create a new banner record in the database
                $bannerPackage = BannerPackage::where('id', $request->input('package'))->first();
                
                if (!$bannerPackage) {
                    return $this->apiResponse->error(
                        'Banner package not found',
                        'Invalid package ID',
                        404
                    );
                }

                $duration = (int)$bannerPackage->no_of_days;
                $expiredAt = Carbon::now()->addDays($duration);
                
                $banner = Banners::create([
                    'img' => $imageName,
                    'type' => $request->input('type'),
                    'url' => $request->input('url'),
                    'package' => $request->input('package'),
                    'expired_at' => $expiredAt
                ]);

                return $this->apiResponse->success(
                    [
                        'id' => $banner->id,
                        'image_url' => asset('banners/' . $imageName),
                        'type' => $banner->type,
                        'url' => $banner->url,
                        'package' => $banner->package,
                        'expired_at' => $expiredAt
                    ],
                    'Banner created successfully'
                );
            }

            return $this->apiResponse->error(
                'No image was provided',
                'Image required',
                400
            );
            
        } catch (\Exception $e) {
            Log::error('Error creating banner: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to create banner', 500);
        }
    }
}
