<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Pest\Support\Str;

class SocialMobileAuthController extends Controller
{
    public function socialLogin()
    {
        request()->validate([
            'provider' => 'required|in:google,facebook',
            'access_token' => 'required',
        ]);

        $provider = request('provider');
        $token = request('access_token');

        try {
            $socialUser = Socialite::driver($provider)->stateless()->userFromToken($token);

            $systemUser = User::where('email', $socialUser->getEmail())
                ->whereNull('social_login_name')
                ->first();

            if ($systemUser) {
                return response()->json([
                    'error' => 'Email already registered. Please login with email/password.'
                ], 409);
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
                    'social_login_name' => $provider,
                ]
            );

            $authToken = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $authToken,
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token or provider'], 401);
        }
    }
}
