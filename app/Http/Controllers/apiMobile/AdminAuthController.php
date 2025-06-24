<?php

namespace App\Http\Controllers\apiMobile;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    /**
     * Handle admin login request.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'login' => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $loginInput = $request->login;
            
            // Try to find the user by phone number first
            $user = User::where('phone_number', $loginInput)->first();
            
            // If not found by phone, try email
            if (!$user && filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $loginInput)->first();
            }

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found with provided credentials.',
                ], 401);
            }

            // Check password
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid password.',
                ], 401);
            }

            // Log password check result
            Log::info('Password check passed for admin login', ['user_id' => $user->id]);

            // Create token - using Laravel Passport
            $tokenResult = $user->createToken('admin_token');
            $token = $tokenResult->accessToken;
            $tokenExpiration = $tokenResult->token->expires_at;
            
            // Log successful authentication
            Auth::login($user);
            
            // Set session values
            session([
                'is_admin' => true,
                'name' => $user->first_name . ' ' . $user->last_name,
                'phone_number' => $user->phone_number,
            ]);

            Log::info('Admin login successful - Token created', [
                'user_id' => $user->id, 
                'role' => $user->roles
            ]);

            // Remove sensitive fields before returning user
            $userData = $user->makeHidden(['password', 'remember_token'])
                ->only(['id', 'first_name', 'last_name', 'email', 'phone_number', 'roles']);

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful.',
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $tokenExpiration,
                'user' => $userData,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Admin login exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Login failed due to server error.',
                'debug' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle admin logout request.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            // Revoke the token that was used to authenticate the current request (Passport)
            if ($request->user()) {
                $request->user()->token()->revoke();
            }

            // Clear session
            $request->session()->flush();

            return response()->json([
                'status' => 'success',
                'message' => 'Admin logged out successfully.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Admin logout exception', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Logout failed.',
            ], 500);
        }
    }
}
