<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'string', 'regex:/^[0-9]{10}$/', 'unique:'.User::class,],
                'password' => ['required',  Rules\Password::defaults()],
            ]);

            $url = strtolower($request['first_name'].' '.$request['last_name']);
            $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
            $url = preg_replace('/\s+/', '-', $url);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'url' => $url,
                'email' => $request->email ?? null,
                'status' => '1',
                'roles' => $request->roles ?? 'user',
                'phone_number' => $request->phone_number ?? null,
                'location' => $request->location ?? null,
                'sub_location' => $request->sub_location ?? null,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully!',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);

        }
    }

    public function loginUser(LoginRequest $request)
    {
        try {
            $request->authenticate();
            $user = auth()->user();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
