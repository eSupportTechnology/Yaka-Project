<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('newAdminDashboard.admin_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'password' => 'required|min:6',
        ]);

        $user = User::where('phone_number', $request->phone_number)
            ->whereIn('roles', ['admin', 'staff'])
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            session([
                'is_admin' => in_array($user->roles, ['admin', 'staff']),
                'name' => $user->name,
                'phone_number' => $user->phone_number,
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
