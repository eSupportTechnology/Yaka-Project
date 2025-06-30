<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\AdsTypes;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
}
