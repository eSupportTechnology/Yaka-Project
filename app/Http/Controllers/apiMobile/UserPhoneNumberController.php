<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserPhoneNumberController extends Controller
{
    // List all phone numbers for a user
    public function index($userId): JsonResponse
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        $phones = UserPhoneNumber::where('user_id', $userId)->get();

        if ($phones->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No phone numbers found for this user.',
                'data' => []
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $phones
        ]);
    }

    // Add a phone number
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone_number' => 'required|unique:user_phone_numbers,phone_number',
            'is_primary' => 'nullable|boolean',
        ]);

        // Ensure only one primary phone number per user
        if (!empty($validated['is_primary']) && $validated['is_primary']) {
            UserPhoneNumber::where('user_id', $validated['user_id'])
                ->where('is_primary', true)
                ->update(['is_primary' => false]);
        }

        $phone = UserPhoneNumber::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Phone number added successfully.',
            'data' => $phone
        ], 201);
    }

    // Update a phone number
    public function update(Request $request, $id): JsonResponse
    {
        $phone = UserPhoneNumber::find($id);

        if (!$phone) {
            return response()->json([
                'success' => false,
                'message' => 'Phone number not found.'
            ], 404);
        }

        $validated = $request->validate([
            'phone_number' => 'unique:user_phone_numbers,phone_number,' . $id,
            'is_primary' => 'nullable|boolean',
        ]);

        // If marked as primary, remove existing primary for this user
        if (!empty($validated['is_primary']) && $validated['is_primary']) {
            UserPhoneNumber::where('user_id', $phone->user_id)
                ->where('is_primary', true)
                ->where('id', '!=', $id)
                ->update(['is_primary' => false]);
        }

        $phone->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Phone number updated successfully.',
            'data' => $phone
        ]);
    }

    // Delete a phone number
    public function destroy($id): JsonResponse
    {
        $phone = UserPhoneNumber::find($id);

        if (!$phone) {
            return response()->json([
                'success' => false,
                'message' => 'Phone number not found.'
            ], 404);
        }

        $phone->delete();

        return response()->json([
            'success' => true,
            'message' => 'Phone number deleted successfully.'
        ]);
    }
}
