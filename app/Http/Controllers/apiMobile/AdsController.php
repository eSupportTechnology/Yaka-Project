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

        if (!$searchTerm) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please provide a title to search.'
            ], 400);
        }

        $ads = Ads::where('title', 'LIKE', '%' . $searchTerm . '%')->get();

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

}
