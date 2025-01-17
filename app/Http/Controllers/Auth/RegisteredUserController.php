<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\SmsService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    protected $smsService;

    // Inject SmsService in the controller constructor
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('web.user.register');
    }

    public function registerOtp(){
        return view('web.user.get-r-otp');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^[0-9]{10}$/', 'unique:'.User::class,],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $url = strtolower($request['first_name'].' '.$request['last_name']);
        $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
        $url = preg_replace('/\s+/', '-', $url);

         $user = [
            'first_name' => $request->first_name,
            'name' => $request->first_name." ".$request->last_name,
            'last_name' => $request->last_name,
            'url' => $url,
            'email' => $request->email ?? null,
            'status' => '1',
            'roles' => $request->roles ?? 'user',
            'phone_number' => $request->phone_number ?? null,
            'location' => $request->location ?? null,
            'sub_location' => $request->sub_location ?? null,
            'password' => Hash::make($request->password),
        ];

        session(['registerUserDate' => $user]);

        $otp = rand(100000, 999999);

        // Get phone number from request
        $phoneNumber = $request->phone_number;


            try {

                $otpMessage = "Your OTP code is: " . $otp;
    
           
                $senderID = "QKSendDemo"; 
                $to = $phoneNumber;
                $message = $otpMessage; 

                // dd($otpMessage , $to);
    
       
                $response = $this->smsService->sendSingleSms($senderID, $to, $message);
    
                session(['otp' => Hash::make($otp)]);
    
                return redirect()->route('register-otp');
    
               
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Failed to send OTP',
                    'error' => $e->getMessage(),
                ], 500);
            }

        

    }


    public function storeRegister(Request $request){

        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $otp = $request->input('otp');

        if (Hash::check($otp, session('otp'))) {

            $user = User::create(session('registerUserDate'));

            event(new Registered($user));

            Auth::login($user);

            $user = auth()->user();

            $userAttributes = $user->getAttributes();
            unset($userAttributes['password']); 

            session(['user' => $userAttributes]);

            return redirect(RouteServiceProvider::HOME);
        } else {
            return redirect()->route('register')->with('error', 'Invalid OTP');
        }


    }
}
