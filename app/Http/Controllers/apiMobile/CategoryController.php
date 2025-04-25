<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function getAllCategories(): JsonResponse
    {
        $categories = Category::all();

        return response()->json([
            'status' => 'success',
            'categories' => $categories,
        ], 200);
    }
}
