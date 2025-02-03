<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
    
        if ($user && Hash::check($request->password, $user->password) && $user->roles === 'user') {
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

    
}
