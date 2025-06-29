<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\BannerPackage;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminBannerPackageCreateController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Create a new banner package
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBannerPackage(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:banner_packages,name',
                'status' => 'required|boolean',
                'no_of_days' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return $this->apiResponse->error(
                    $validator->errors(),
                    'Validation failed',
                    422
                );
            }

            // Create the banner package
            $bannerPackage = BannerPackage::create([
                'name' => $request->input('name'),
                'status' => $request->input('status'),
                'no_of_days' => $request->input('no_of_days'),
            ]);

            // Log the successful creation
            Log::info('Banner package created via API', ['id' => $bannerPackage->id, 'name' => $bannerPackage->name]);

            // Return success response with the created banner package
            return $this->apiResponse->success(
                $bannerPackage,
                'Banner package created successfully'
            );
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating banner package via API: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return error response
            return $this->apiResponse->error(
                $e->getMessage(),
                'Failed to create banner package',
                500
            );
        }
    }
}
