<?php

namespace App\Http\Controllers\apiMobile;

use App\Models\User;

use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    public function logout(Request $request, ApiResponseService $apiResponse): JsonResponse
    {

        Auth::logout();


        Log::info('User logged out successfully');


        return $apiResponse->success(null, 'Logged out successfully.', 200);
    }


     public function register(Request $request, ApiResponseService $apiResponse)
     {

         $validator = Validator::make($request->all(), [
             'first_name' => 'required|string|max:255',
             'last_name' => 'required|string|max:255',
             'phone_number' => 'required|string|unique:users,phone_number',
             'email' => 'required|string|email|max:255|unique:users,email',
             'password' => 'required|string|confirmed|min:8',
         ]);

         if ($validator->fails()) {
             return $apiResponse->error($validator->errors(),  'Validation failed.', 422);
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

             return $apiResponse->success($user, 'User registered successfully.', 201);
         } catch (\Exception $e) {

             Log::error('Error during registration', ['error_message' => $e->getMessage()]);
             return $apiResponse->error($e->getMessage(), 'An error occurred during registration.', 500);
         }
     }

     public function mobileLogin(Request $request, ApiResponseService $apiResponse)
     {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $apiResponse->error($validator->errors(),  'Validation failed.', 422);
        }

        $loginInput = $request->login;
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        $user = User::where($fieldType, $loginInput)->first();
        if ($user && Hash::check($request->password, $user->password) && $user->roles === 'user') {

            if($user->phone_number == 0) {
                return $apiResponse->error(null,  'Mobile Number Not Verified', 500);
            }
            // No need to Auth::login() for API

            Log::info('User logged in successfully', ['user_id' => $user->id]);
            // Create Passport personal access token
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;
            $tokenExpiration = $tokenResult->token->expires_at;

            // Remove sensitive fields before returning user
            $userData = $user->makeHidden(['password', 'remember_token'])
                        ->only(['id', 'first_name', 'last_name', 'name', 'profileImage', 'email', 'phone_number', 'roles', 'is_mobile_verifed']);

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful.',
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $tokenExpiration,
                'user' => $userData,
            ], 200);
        }

        Log::error('Login failed', ['login_input' => $loginInput]);

        return $apiResponse->error(null,  'Invalid login credentials', 401);
     }

    /**
     * Send mobile verification code
    */
    public function SendMobileVerificationCode(Request $request, ApiResponseService $apiResponse)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
        ]);

        if ($validator->fails()) {
            return $apiResponse->error($validator->errors(),  'Validation failed.', 422);
        }

        $user = User::where('phone_number', $request->mobile)->first();
        if(!$user) {
            return $apiResponse->error(null,  'User not found with entered mobile number.', 500);
        }
        $verificationCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->otp = $verificationCode;
        $user->save();
        if(!OtpService::sendSingleSms($request->mobile, "Verification Code: ".$verificationCode)) {
            return $apiResponse->error(null,  'Sending verifcation code failed. Try again.', 500);
        }
        $data = [
            'mobile' => $request->mobile,
            'verification_code' => $verificationCode,
        ];
        return $apiResponse->success($data, 'Verification Code successfully Sent.', 200);
    }

    /**
     * Verify registration OTP
     */
    public function verifyRegistrationOtp(Request $request, ApiResponseService $apiResponse)
    {
        $validator = Validator::make($request->all(), [
            'verification_code' => ['required'],
            'mobile' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
        ]);

        if ($validator->fails()) {
            return $apiResponse->error($validator->errors(),  'Validation failed.', 422);
        }

        try {
            $mobile = $request->mobile;
            $user = User::where('phone_number', $mobile)->first();
            if(!$user) {
                return $apiResponse->error(null,  'User not found with entered mobile number.', 500);
            }
            $verificationCode = $request->verification_code;
            if($user->is_mobile_verifed == 1) {
                return $apiResponse->error(null,  'User Already Verified.', 500);
            }
            if($user->otp != $verificationCode) {
                return $apiResponse->error(null,  'Verification code invalid.', 500);
            }
            $user->is_mobile_verifed = 1;
            $user->save();

            return $apiResponse->success($user, 'Mobile Verification Completed.', 200);
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error during sending verification code', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return $apiResponse->error($e->getMessage(),  'Error during sending verification code', 500);
        }
    }
}
