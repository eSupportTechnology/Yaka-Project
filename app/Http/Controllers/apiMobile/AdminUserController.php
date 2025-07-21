<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;

class AdminUserController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function updateAdmin(Request $request, $id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->apiResponse->error(
                    'Admin not found',
                    'No admin found with the given ID',
                    404
                );
            }

            $validated = $request->validate([
                'first_name'   => 'required|string|max:255',
                'last_name'    => 'required|string|max:255',
                'email'        => ['required', 'email'],
                'phone_number' => 'nullable|string|max:20',
            ]);

            $url = strtolower($validated['first_name'] . '-' . $validated['last_name']);
            $url = preg_replace('/[^a-z0-9\-]/', '', $url);
            $url = preg_replace('/-+/', '-', $url);

            $user->update([
                'first_name'   => $validated['first_name'],
                'last_name'    => $validated['last_name'],
                'email'        => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'url'          => $url,
            ]);

            return $this->apiResponse->success(
                $user,
                'Admin updated successfully'
            );
        } catch (\Exception $e) {
            return $this->apiResponse->error(
                $e->getMessage(),
                'Failed to update admin',
                500
            );
        }
    }

    public function deleteAdmin($id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->apiResponse->error(
                    'Admin not found',
                    'No admin found with the given ID',
                    404
                );
            }

            $user->delete();

            return $this->apiResponse->success(
                null,
                'Admin deleted successfully'
            );
        } catch (\Exception $e) {
            return $this->apiResponse->error(
                $e->getMessage(),
                'Failed to delete admin',
                500
            );
        }
    }
}
