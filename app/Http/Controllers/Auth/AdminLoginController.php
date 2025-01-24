<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('adminPanel.adminlogin'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|regex:/^[0-9]{10}$/', 
            'password' => 'required|min:6',
        ]);
    
        $admin = User::where('phone_number', $request->phone_number)
            ->where('roles', 'admin')  
            ->first();
    
        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'is_admin' => true, 
                'name' => $admin->name, 
                'phone_number' => $admin->phone_number,
            ]);
            return redirect()->route('dashboard');
        }
    
        return back()->withErrors(['phone_number' => 'Invalid credentials.'])->withInput();
    }
    
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
