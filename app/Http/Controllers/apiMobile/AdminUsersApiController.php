<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminUsersApiController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get user list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersList(Request $request)
    {
        try {
            // Get filter parameters
            $search = $request->get('search');
            $role = $request->get('role', 'user'); // Default to 'user' role if not specified
            $status = $request->get('status');
            
            // Start building the query
            $usersQuery = User::query();
            
            // Filter by role
            $usersQuery->where('roles', $role);
            
            // Apply search filter if provided
            if (!empty($search)) {
                $usersQuery->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                          ->orWhere('last_name', 'like', '%' . $search . '%')
                          ->orWhere('phone_number', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                });
            }
            
            // Filter by status if provided
            if (isset($status) && $status !== '') {
                $usersQuery->where('status', $status);
            }
            
            // Order by latest users (newest first)
            $usersQuery->orderBy('created_at', 'desc');
            
            // Paginate results
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            
            $userData = $usersQuery->paginate($perPage, ['*'], 'page', $page);
            
            // Remove sensitive information from user data
            $users = $userData->map(function ($user) {
                return $user->makeHidden(['password', 'remember_token']);
            });
            
            return $this->apiResponse->success([
                'users' => $users->values(),
                'pagination' => [
                    'total' => $userData->total(),
                    'per_page' => $userData->perPage(),
                    'current_page' => $userData->currentPage(),
                    'last_page' => $userData->lastPage()
                ]
            ], 'Users list fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching admin users list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch users list', 500);
        }
    }
}
