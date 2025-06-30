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
     * Get main categories list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories(Request $request)
    {
        try {
            // Get filter parameters
            // $mainCategoryOnly parameter is no longer needed as we always fetch main categories
            $search = $request->get('search');
            $status = $request->get('status');
            
            // Start building the query
            $categoryQuery = Category::query();
            
            // Always filter for main categories only (where mainId = 0)
            $categoryQuery->where('mainId', 0);
            
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
            
            // Transform categories to include image_url
            $categoryData->getCollection()->transform(function ($category) {
                // For main categories, the image path is always Category
                $imagePath = 'images/Category/';
                
                // Add image_url if image exists
                if ($category->image) {
                    $category->image_url = "https://yakalk.esupportsystem.shop/" . $imagePath . $category->image;
                } else {
                    $category->image_url = null;
                }
                
                // Add subcategories count for each main category
                $category->subcategories_count = Category::where('mainId', $category->id)->count();
                
                return $category;
            });
            
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

    /**
     * Store a newly created category
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeCategory(Request $request)
    {
        try {
            // Validate incoming data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|boolean',
                'mainId' => 'nullable|exists:categories,id',
                'free_add_count' => 'nullable|integer|min:0'
            ]);

            // Determine image path based on whether it's a subcategory or not
            $imagePath = isset($validatedData['mainId']) ? 'images/SubCategory' : 'images/Category';

            // Process image if provided
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path($imagePath), $imageName);
            } else {
                $imageName = null;
            }

            // Create a new category instance
            $category = new Category();
            $category->name = $validatedData['name'];
            $category->mainId = $validatedData['mainId'] ?? 0;
            $category->image = $imageName;
            $category->url = $category->createUrl($validatedData['name']);
            $category->status = $validatedData['status'];
            
            // Add free_add_count if it's a main category
            if (!isset($validatedData['mainId']) || $validatedData['mainId'] == 0) {
                $category->free_add_count = $validatedData['free_add_count'] ?? 0;
            }

            // Save the category
            $category->save();

            return $this->apiResponse->success(
                $category, 
                'Category created successfully'
            );
            
        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
        return $this->apiResponse->error($e->getMessage(), 'Failed to create category', 500);
    }
}
        }
