<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function searchByTitle(Request $request)
{
    $searchTerm = $request->input('title');
    $userId = $request->input('user_id');
    if (!$searchTerm) {
        return response()->json([
            'status' => 'error',
            'message' => 'Please provide a title to search.'
        ], 400);
    }

    if (!$userId) {
        return response()->json([
            'status' => 'error',
            'message' => 'Please provide a user ID.'
        ], 400);
    }

    $ads = Ads::where('title', 'LIKE', '%' . $searchTerm . '%')
              ->where('user_id', '!=', $userId)
              ->get();

    if ($ads->isEmpty()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Item not found.',
            'data' => []
        ], 200);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Ads found successfully.',
        'count' => $ads->count(),
        'data' => $ads
    ], 200);
}

//delete ads
public function deleteById($id)
{
    $ad = Ads::find($id);

    if (!$ad) {
        return response()->json([
            'status' => 'error',
            'message' => 'Ad not found.'
        ], 404);
    }

    $ad->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Ad deleted successfully.'
    ], 200);
}



}
