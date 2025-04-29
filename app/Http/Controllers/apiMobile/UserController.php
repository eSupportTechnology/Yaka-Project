<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getUserById($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.',
                ], 404);
            }


            $user->makeHidden(['password', 'remember_token']);

            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching user: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving the user.',
            ], 500);
        }
    }
}
