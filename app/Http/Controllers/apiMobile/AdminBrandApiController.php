<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\BrandsModels;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminBrandApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get brand list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBrandsList(Request $request)
    {
        try {
            // Get filter parameters
            $search = $request->get('search');
            $status = $request->get('status');
            $categoryId = $request->get('category_id');
            
            // Start building the query for brands with eager loading
            $brandsQuery = BrandsModels::where('brandsId', 0) // Only main brands, not models
                ->with('category') // Eager load the category relationship
                ->orderBy('id', 'DESC');
            
            // Apply filters if provided
            if (!empty($search)) {
                $brandsQuery->where('name', 'like', '%' . $search . '%');
            }
            
            if (isset($status) && $status !== '') {
                $brandsQuery->where('status', $status);
            }
            
            if (!empty($categoryId)) {
                $brandsQuery->where('sub_cat_id', $categoryId);
            }
            
            // Paginate results
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            
            $brandsData = $brandsQuery->paginate($perPage, ['*'], 'page', $page);
            
            // Format the data for the response
            $formattedBrands = $brandsData->map(function ($brand) {
                return [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'url' => $brand->url,
                    'status' => $brand->status,
                    'status_text' => $brand->status == 1 ? 'Active' : 'Inactive',
                    'category' => $brand->category ? $brand->category->name : null,
                    'category_id' => $brand->sub_cat_id,
                    'models_count' => BrandsModels::where('brandsId', $brand->id)->count()
                ];
            });
            
            return $this->apiResponse->success([
                'brands' => $formattedBrands,
                'pagination' => [
                    'total' => $brandsData->total(),
                    'per_page' => $brandsData->perPage(),
                    'current_page' => $brandsData->currentPage(),
                    'last_page' => $brandsData->lastPage()
                ]
            ], 'Brands list fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching brands list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch brands list', 500);
        }
    }
    
    /**
     * Get models for a specific brand
     * 
     * @param Request $request
     * @param int $brandId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBrandModels(Request $request, $brandId)
    {
        try {
            // Check if brand exists
            $brand = BrandsModels::where('id', $brandId)
                ->where('brandsId', 0)
                ->first();
                
            if (!$brand) {
                return $this->apiResponse->error('Brand not found', 'Brand not found with the provided ID', 404);
            }
            
            // Get filter parameters
            $search = $request->get('search');
            $status = $request->get('status');
            
            // Start building the query for models
            $modelsQuery = BrandsModels::where('brandsId', $brandId)
                ->orderBy('id', 'DESC');
            
            // Apply filters if provided
            if (!empty($search)) {
                $modelsQuery->where('name', 'like', '%' . $search . '%');
            }
            
            if (isset($status) && $status !== '') {
                $modelsQuery->where('status', $status);
            }
            
            // Paginate results
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            
            $modelsData = $modelsQuery->paginate($perPage, ['*'], 'page', $page);
            
            // Format the data for the response
            $formattedModels = $modelsData->map(function ($model) {
                return [
                    'id' => $model->id,
                    'name' => $model->name,
                    'url' => $model->url,
                    'status' => $model->status,
                    'status_text' => $model->status == 1 ? 'Active' : 'Inactive'
                ];
            });
            
            return $this->apiResponse->success([
                'brand' => [
                    'id' => $brand->id,
                    'name' => $brand->name
                ],
                'models' => $formattedModels,
                'pagination' => [
                    'total' => $modelsData->total(),
                    'per_page' => $modelsData->perPage(),
                    'current_page' => $modelsData->currentPage(),
                    'last_page' => $modelsData->lastPage()
                ]
            ], 'Brand models fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching brand models: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch brand models', 500);
        }
    }
}
