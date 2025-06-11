<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{


    public function login(Request $request)
    {
        Log::info('Login request received', $request->all());

        $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('phone_number', $request->phone_number)->first();

        // Check mobile is verifed
        if($user->is_mobile_verifed == 0) {
            return redirect()->route('user.login')->with('active_error', "Mobile Number Not Verifed. Please Verify Mobile First");
        }

        if ($user && Hash::check($request->password, $user->password) && in_array($user->roles, ['user', 'staff'])) {
            Auth::login($user);
            Log::info('User logged in successfully', ['user_id' => $user->id]);

            return redirect()->intended('/');
        }

        Log::error('Login failed', ['phone_number' => $request->phone_number]);
        return back()->withErrors(['login_error' => 'Invalid phone number, password, or role.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Verify mobile numer
    public function verifyMobile()
    {
        return view('newFrontend.verify-mobile');
    }

    // Send verification OTP
    public function verifyMobileSendCode(Request $request)
    {
        try {

            $request->validate([
                'phone_number' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            ]);

            //Fetch user based on the mobile
            $user = User::where('phone_number', $request->phone_number)->first();
            if(!$user) {
                return redirect()->back()->with('error', "User not found with entered mobile number");
            }
            $verificationCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $user->otp = $verificationCode;
            $user->save();
            if(!OtpService::sendSingleSms($request->phone_number, "Verification Code: ".$verificationCode)) {
                return redirect()->route('verify-mobile.send-code')->with('error', 'Sending verifcation code failed. Try again');
            }
            session(['verifying-mobile' => $request->phone_number]);

            return view('newFrontend.enter-otp');

        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error during sending verification code', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Check the code and verify
     */
    public function verifyMobileCheckCode(Request $request)
    {
        $request->validate([
            'verification_code' => ['required'],
        ]);

        try {
            $mobile = session('verifying-mobile');
            $user = User::where('phone_number', $mobile)->first();
            $verificationCode = $request->verification_code;
            if($user->otp != $verificationCode) {
                return redirect()->back()->with('error', "Verification code invalid");
            }
            $user->is_mobile_verifed = 1;
            $user->save();

            return redirect()->route('user.login')->with('success', 'Mobile Verification Completed.');
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error during sending verification code', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
