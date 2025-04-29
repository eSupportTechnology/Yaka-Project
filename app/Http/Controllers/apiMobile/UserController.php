<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Exception;

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



    public function update(Request $request, $id)
    {
        try {

            $validatedData = $request->validate([
                'first_name'    => 'required|string|max:255',
                'last_name'     => 'required|string|max:255',
                'email'         => 'required|email|unique:users,email,' . $id,
                'phone_number'  => 'nullable|string|max:20',
                'location'      => 'nullable|string|max:255',
            ]);


            $user = User::findOrFail($id);


            $user->first_name   = $validatedData['first_name'];
            $user->last_name    = $validatedData['last_name'];
            $user->email        = $validatedData['email'];
            $user->phone_number = $validatedData['phone_number'] ?? null;
            $user->location     = $validatedData['location'] ?? null;

            $user->save();

            return response()->json([
                'message' => 'User updated successfully.',
                'user' => $user
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors'  => $e->errors()
            ], 422);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
