<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminCategoryApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get categories list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories(Request $request)
    {
        try {
            // Get filter parameters
            $mainCategoryOnly = $request->boolean('main_only', false);
            $search = $request->get('search');
            $status = $request->get('status');
            
            // Start building the query
            $categoryQuery = Category::query();
            
            // Filter by main categories or include subcategories
            if ($mainCategoryOnly) {
                $categoryQuery->where('mainId', 0);
            }
            
            // Apply search filter if provided
            if (!empty($search)) {
                $categoryQuery->where('name', 'like', '%' . $search . '%');
            }
            
            // Filter by status if provided
            if (isset($status) && $status !== '') {
                $categoryQuery->where('status', $status);
            }
            
            // Order by name
            $categoryQuery->orderBy('name', 'asc');
            
            // Paginate results
            $perPage = $request->get('per_page', 15);
            $page = $request->get('page', 1);
            
            $categoryData = $categoryQuery->paginate($perPage, ['*'], 'page', $page);
            
            // If we're fetching main categories, also include their subcategories count
            if ($mainCategoryOnly) {
                $categoryData->getCollection()->transform(function ($category) {
                    $category->subcategories_count = Category::where('mainId', $category->id)->count();
                    return $category;
                });
            }
            
            return $this->apiResponse->success([
                'categories' => $categoryData->items(),
                'pagination' => [
                    'total' => $categoryData->total(),
                    'per_page' => $categoryData->perPage(),
                    'current_page' => $categoryData->currentPage(),
                    'last_page' => $categoryData->lastPage()
                ]
            ], 'Categories fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching admin categories list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch categories list', 500);
        }
    }
}
