<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\SmsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class AuthenticatedSessionController extends Controller
{
    protected $smsService;

    // Inject SmsService in the controller constructor
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Display the login view.
     */
    public function create()
    {
        return view('web.user.login');
    }

    public function forgot()
    {
        return view('web.user.send-otp');
    }

    public function sendOTP(Request $request)
    {

        $request->validate([
            'phone_number' => 'required|numeric|digits:10',
        ]);

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Get phone number from request
        $phoneNumber = $request->input('phone_number');

         // Use SmsService to send OTP
        try {

            $otpMessage = "Your OTP code is: " . $otp;

       
            $senderID = "QKSendDemo"; 
            $to = $phoneNumber;
            $message = $otpMessage; 

   
            $response = $this->smsService->sendSingleSms($senderID, $to, $message);

            session(['otp' => Hash::make($otp)]);
            session(['forgotPhoneNumber' => $phoneNumber]);

            return redirect()->route('comfirmOtpView');

           
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send OTP',
                'error' => $e->getMessage(),
            ], 500);
        }
      
    }

    public function comfirmOtpView()
    {
        return view('web.user.get-otp');
    }


    public function comfirmOtp(Request $request)
    {

        $request->validate([
            'otp' => 'required|numeric|digits:6',
            'password' => 'required|min:8',
        ]);

        $otp = $request->input('otp');
        $password = $request->input('password');

        if (Hash::check($otp, session('otp'))) {

          
            $otpMessage = "Your New Password is: " . $password;

            $user = User::where('phone_number', session('forgotPhoneNumber'))->first();
            $user->password = Hash::make($password);
            $user->save();


            $senderID = "QKSendDemo"; 
            $to = session('forgotPhoneNumber');
            $message = $otpMessage; 

            $response = $this->smsService->sendSingleSms($senderID, $to, $message);

            return redirect()->route('login')->with('success', 'Password changed successfully');
        } else {
            return redirect()->route('forgot')->with('error', 'Invalid OTP');
        }
        
    }

    function generatePassword($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $password = '';
    
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $password .= $characters[$index];
        }
    
        return $password;
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = auth()->user();

        $userAttributes = $user->getAttributes();
        unset($userAttributes['password']); // Remove the 'password' attribute from the array

        session(['user' => $userAttributes]);


        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
