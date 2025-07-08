<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\AdsTypes;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Validation\Rule;

class AdminTypeApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get type list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTypesList(Request $request)
    {
        try {
            // Get filter parameters
            $search = $request->get('search');
            $status = $request->get('status');
            $categoryId = $request->get('category_id');
            
            // Start building the query with category relationship
            $typesQuery = AdsTypes::with('category')->orderBy('id', 'DESC');
            
            // Apply filters if provided
            if (!empty($search)) {
                $typesQuery->where('name', 'like', '%' . $search . '%');
            }
            
            if (isset($status) && $status !== '') {
                $typesQuery->where('status', $status);
            }

            if (!empty($categoryId)) {
                $typesQuery->where('catergoryId', $categoryId);
            }
            
            // Paginate results
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            
            $typesData = $typesQuery->paginate($perPage, ['*'], 'page', $page);
            
            // Format the response
            $formattedTypes = $typesData->map(function ($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                    'url' => $type->url,
                    'status' => $type->status,
                    'status_text' => $type->status == 1 ? 'Active' : 'Inactive',
                    'category' => $type->category ? $type->category->name : null,
                    'category_id' => $type->catergoryId
                ];
            });
            
            return $this->apiResponse->success([
                'types' => $formattedTypes,
                'pagination' => [
                    'total' => $typesData->total(),
                    'per_page' => $typesData->perPage(),
                    'current_page' => $typesData->currentPage(),
                    'last_page' => $typesData->lastPage()
                ]
            ], 'Types list fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching types list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch types list', 500);
        }
    }
    
    /**
     * Create a new type
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createType(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('table_ad_types', 'name')->where('catergoryId', $request->input('category_id')),
                ],
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return $this->apiResponse->error(
                    $validator->errors(),
                    'Validation failed',
                    422
                );
            }

            // Get the subcategory information
            $subcategory = Category::findOrFail($request->input('category_id'));
            
            // Generate a URL based on category name and type name
            $url = strtolower($subcategory->name . ' ' . $request->input('name'));
            $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
            $url = preg_replace('/\s+/', '-', $url);
            
            // Create the type
            $type = new AdsTypes();
            $type->name = $request->input('name');
            $type->catergoryId = $request->input('category_id');
            $type->url = $url;
            $type->status = $request->input('status');
            $type->save();
            
            // Log success
            Log::info('Type created via API', ['id' => $type->id, 'name' => $type->name]);
            
            return $this->apiResponse->success(
                $type,
                'Type created successfully'
            );
            
        } catch (\Exception $e) {
            Log::error('Error creating type via API: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return $this->apiResponse->error(
                $e->getMessage(),
                'Failed to create type',
                500
            );
        }
    }
}
