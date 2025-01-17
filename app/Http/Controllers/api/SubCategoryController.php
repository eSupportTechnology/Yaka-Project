<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($category)
    {
        $category = Category::where('mainId',$category)->get();

        return response()->json([
            'status'=>true,
            'categories'=>$category
        ],200);
    }
}
