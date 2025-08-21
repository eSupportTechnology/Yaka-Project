<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Storage;

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

    public function userUpdate(Request $request, $id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->apiResponse->error('User not found', 'No user found with the given ID', 404);
            }

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'company' => 'nullable|string|max:255',
                'postCode' => 'nullable|string|max:255',
                'website' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone_number' => 'nullable|string|max:20',
                'birthday' => 'nullable|date',
                'location' => 'nullable|exists:districts,id',
                'sublocation' => 'nullable|exists:cities,id',
                'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'company' => $request->company,
                'postCode' => $request->postCode,
                'website' => $request->website,
                'phone_number' => $request->phone_number,
                'birthday' => $request->birthday,
                'location' => $request->location,
                'sub_location' => $request->sublocation,
            ];

            if ($request->hasFile('profileImage')) {
                if ($user->profileImage) {
                    Storage::delete('public/profile_images/' . $user->profileImage);
                }

                $originalName = $request->file('profileImage')->getClientOriginalName();
                $request->file('profileImage')->storeAs('public/profile_images', $originalName);

                $data['profileImage'] = $originalName;
            }

            $user->update($data);

            return $this->apiResponse->success($user->fresh(), 'User profile updated successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to update user profile', 500);
        }
    }

}
