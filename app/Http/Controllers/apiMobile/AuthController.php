<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AuthControllerMobile extends Controller
{
    public function login(Request $request): JsonResponse
{
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
    $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

    $user = User::where($fieldType, $loginInput)->first();

    if ($user && Hash::check($request->password, $user->password) && $user->roles === 'user') {
        Auth::login($user);

        Log::info('User logged in successfully', ['user_id' => $user->id]);

        $token = $user->createToken('mobile_token')->plainTextToken;

        // Remove sensitive fields before returning user
        $userData = $user->makeHidden(['password', 'remember_token']);

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'token' => $token,
            'user' => $userData,
        ], 200);
    }

    Log::error('Login failed', ['login_input' => $loginInput]);

    return response()->json([
        'status' => 'error',
        'message' => 'Invalid login credentials.',
    ], 401);
}
    /**
     * Handle user logout request.
     */
    public function logout(Request $request): JsonResponse
    {

        Auth::logout();


        Log::info('User logged out successfully');


        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully.',
        ], 200);
    }


     public function register(Request $request)
     {

         $validator = Validator::make($request->all(), [
             'first_name' => 'required|string|max:255',
             'last_name' => 'required|string|max:255',
             'phone_number' => 'required|string|unique:users,phone_number',
             'email' => 'required|string|email|max:255|unique:users,email',
             'password' => 'required|string|confirmed|min:8',
         ]);

         if ($validator->fails()) {
             return response()->json([
                 'status' => 'error',
                 'message' => 'Validation failed.',
                 'errors' => $validator->errors()
             ], 422);
         }


         try {
             $user = User::create([
                 'first_name' => $request->first_name,
                 'last_name' => $request->last_name,
                 'phone_number' => $request->phone_number,
                 'email' => $request->email,
                 'password' => Hash::make($request->password),
             ]);


             Log::info('New user registered', ['user_id' => $user->id]);


             return response()->json([
                 'status' => 'success',
                 'message' => 'User registered successfully.',
                 'user' => $user
             ], 201);
         } catch (\Exception $e) {

             Log::error('Error during registration', ['error_message' => $e->getMessage()]);

             return response()->json([
                 'status' => 'error',
                 'message' => 'An error occurred during registration.'
             ], 500);
         }
     }
}
