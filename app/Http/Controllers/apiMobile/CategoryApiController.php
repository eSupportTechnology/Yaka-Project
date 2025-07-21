<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;

class CategoryApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function updateCategories(Request $request, $id): JsonResponse
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return $this->apiResponse->error('Category not found', 'No category found with the given ID', 404);
            }

            $rules = [
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required',
                'free_add_count' => 'nullable|integer|min:0'
            ];

            if ($category->name !== $request->name) {
                $rules['name'] = 'required|string|max:255';
            }

            $validated = $request->validate($rules);

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/Category'), $imageName);
                $category->image = $imageName;
            }

            $url = strtolower($validated['name'] ?? $category->name);
            $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
            $url = preg_replace('/\s+/', '-', $url);

            $category->name = $validated['name'] ?? $category->name;
            $category->status = $validated['status'];
            if (!$request->filled('mainid')) {
                $category->free_add_count = $validated['free_add_count'] ?? $category->free_add_count;
            }
            $category->url = $url;
            $category->save();

            return $this->apiResponse->success($category, 'Category updated successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to update category', 500);
        }
    }

    public function deleteCategories($id): JsonResponse
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return $this->apiResponse->error('Category not found', 'No category found with the given ID', 404);
            }

            $category->delete();

            return $this->apiResponse->success(null, 'Category deleted successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to delete category', 500);
        }
    }
}
