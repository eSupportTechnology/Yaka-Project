<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        $systemUser = User::where('email', $socialUser->getEmail())->whereNull('social_login_name')->first();
        if($systemUser) {
            return redirect()->route('custom.login')->with('error', 'Already you have an account with your email, Please login with your email');
        }
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'first_name' => explode(' ', $socialUser->getName())[0] ?? 'N/A',
                'last_name' => explode(' ', $socialUser->getName())[1] ?? 'N/A',
                'password' => bcrypt(Str::random(24)),
                'email_verified_at' => now(),
                'status' => 1,
                'active_status' => 1,
                'is_mobile_verifed' => 0,
                'social_login_name' => $provider
            ]
        );

        Auth::login($user);

        return redirect()->intended('/user/dashboard');
    }
}
