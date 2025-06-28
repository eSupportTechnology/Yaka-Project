<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Get admins list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAdminsList(Request $request)
    {
        try {
            // Get filter parameters
            $search = $request->get('search');
            $status = $request->get('status');
            
            // Start building the query - specifically for admin users
            $adminsQuery = User::query()->where('roles', 'admin');
            
            // Apply search filter if provided
            if (!empty($search)) {
                $adminsQuery->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                          ->orWhere('last_name', 'like', '%' . $search . '%')
                          ->orWhere('phone_number', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                });
            }
            
            // Filter by status if provided
            if (isset($status) && $status !== '') {
                $adminsQuery->where('status', $status);
            }
            
            // Order by latest (newest first)
            $adminsQuery->orderBy('created_at', 'desc');
            
            // Paginate results
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            
            $adminData = $adminsQuery->paginate($perPage, ['*'], 'page', $page);
            
            // Remove sensitive information from admin data
            $admins = $adminData->map(function ($admin) {
                return $admin->makeHidden(['password', 'remember_token']);
            });
            
            return $this->apiResponse->success([
                'admins' => $admins->values(),
                'pagination' => [
                    'total' => $adminData->total(),
                    'per_page' => $adminData->perPage(),
                    'current_page' => $adminData->currentPage(),
                    'last_page' => $adminData->lastPage()
                ]
            ], 'Admin list fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching admin list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch admin list', 500);
        }
    }

    /**
     * Create a new admin user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAdmin(Request $request)
    {
        try {
            // Validate incoming request
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone_number' => 'required|string|unique:users,phone_number',
                'email' => 'nullable|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return $this->apiResponse->error(
                    $validator->errors(),
                    'Validation failed',
                    422
                );
            }

            // Generate a URL based on first and last name
            $url = strtolower($request->first_name . '-' . $request->last_name);
            $url = preg_replace('/[^a-z0-9\-]/', '', $url);
            $url = preg_replace('/-+/', '-', $url);

            // Create new admin user
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone_number = $request->phone_number;
            $user->email = $request->email ?? null;
            $user->roles = 'admin';
            $user->url = $url;
            $user->status = 1;
            $user->password = Hash::make($request->password);
            $user->save();

            // Remove sensitive information before returning
            $userData = $user->makeHidden(['password', 'remember_token']);
            
            Log::info('Admin user created via API', ['admin_id' => $user->id]);
            
            return $this->apiResponse->success(
                $userData,
                'Admin user created successfully'
            );
            
        } catch (\Exception $e) {
            Log::error('Error creating admin user via API: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return $this->apiResponse->error(
                $e->getMessage(),
                'Failed to create admin user',
                500
            );
        }
    }

    /**
     * Get staff list with optional filtering and pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStaffList(Request $request)
    {
        try {
            // Get filter parameters
            $search = $request->get('search');
            $status = $request->get('status');
            
            // Start building the query - specifically for staff users
            $staffQuery = User::query()->where('roles', 'staff');
            
            // Apply search filter if provided
            if (!empty($search)) {
                $staffQuery->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                          ->orWhere('last_name', 'like', '%' . $search . '%')
                          ->orWhere('phone_number', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                });
            }
            
            // Filter by status if provided
            if (isset($status) && $status !== '') {
                $staffQuery->where('status', $status);
            }
            
            // Order by latest (newest first)
            $staffQuery->orderBy('created_at', 'desc');
            
            // Paginate results
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);
            
            $staffData = $staffQuery->paginate($perPage, ['*'], 'page', $page);
            
            // Remove sensitive information from staff data
            $staff = $staffData->map(function ($staffMember) {
                return $staffMember->makeHidden(['password', 'remember_token']);
            });
            
            return $this->apiResponse->success([
                'staff' => $staff->values(),
                'pagination' => [
                    'total' => $staffData->total(),
                    'per_page' => $staffData->perPage(),
                    'current_page' => $staffData->currentPage(),
                    'last_page' => $staffData->lastPage()
                ]
            ], 'Staff list fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching staff list: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch staff list', 500);
        }
    }
}
