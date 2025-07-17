<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;

class UserApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function updateUser(Request $request, $id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->apiResponse->error('User not found', 'No user found with the given ID', 404);
            }

            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => ['required', 'email'],
                'phone_number' => 'nullable|string|max:20',
            ]);

            $url = strtolower($validatedData['first_name'] . '-' . $validatedData['last_name']);
            $url = preg_replace('/[^a-z0-9\-]/', '', $url);
            $url = preg_replace('/-+/', '-', $url);

            $user->update([
                'first_name'   => $validatedData['first_name'],
                'last_name'    => $validatedData['last_name'],
                'email'        => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'url'          => $url,
            ]);

            return $this->apiResponse->success($user, 'User updated successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to update user', 500);
        }
    }

    public function deleteUser($id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->apiResponse->error('User not found', 'No user found with the given ID', 404);
            }

            $user->delete();

            return $this->apiResponse->success(null, 'User deleted successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to delete user', 500);
        }
    }

    public function findByPhoneUser($number): JsonResponse
    {
        try {
            $user = User::where('roles', 'user')
                ->where('phone_number', $number)
                ->select('id', 'first_name', 'last_name', 'email', 'phone_number', 'url', 'status')
                ->first();

            if (!$user) {
                return $this->apiResponse->error('User not found', 'No user with this phone number', 404);
            }

            return $this->apiResponse->success($user, 'User fetched successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch user', 500);
        }
    }

    public function userGetUserId($id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->apiResponse->error('User not found', 'No user found with the given ID', 404);
            }

            return $this->apiResponse->success($user, 'User details fetched successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch user details', 500);
        }
    }


}
