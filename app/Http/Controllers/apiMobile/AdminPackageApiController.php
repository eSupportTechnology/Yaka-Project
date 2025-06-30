<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminPackageApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get package list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPackagesList(Request $request)
    {
        try {
            // Get filter parameters
            $search = $request->get('search');
            $status = $request->get('status');
            
            // Start building the query
            $packagesQuery = Package::query();
            
            // Apply filters if provided
            if (!empty($search)) {
                $packagesQuery->where(function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                          ->orWhere('url', 'like', '%' . $search . '%');
                });
            }
            
            if (isset($status) && $status !== '') {
                $packagesQuery->where('status', $status);
            }
            
            // Order by ID
            $packagesQuery->orderBy('id', 'asc');
            
            // Paginate results
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            
            $packagesData = $packagesQuery->paginate($perPage, ['*'], 'page', $page);
            
            // Format the response to match the UI
            $formattedPackages = $packagesData->map(function($package) {
                return [
                    'id' => $package->id,
                    'url' => $package->url,
                    'name' => $package->name,
                    'status' => $package->status,
                    'status_text' => $package->status == 1 ? 'Active' : 'Inactive'
                ];
            });
            
            return $this->apiResponse->success([
                'packages' => $formattedPackages,
                'pagination' => [
                    'total' => $packagesData->total(),
                    'per_page' => $packagesData->perPage(),
                    'current_page' => $packagesData->currentPage(),
                    'last_page' => $packagesData->lastPage()
                ]
            ], 'Packages list fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching packages list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch packages list', 500);
        }
    }
}
