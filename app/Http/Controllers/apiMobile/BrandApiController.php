<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\BrandsModels;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\ApiResponseService;

class BrandApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function searchBrands(Request $request): JsonResponse
    {
        try {
            $name = $request->get('name');

            $query = BrandsModels::where('brandsId', 0)->with('category')->orderByDesc('id');

            if (!empty($name)) {
                $query->where('name', 'like', '%' . $name . '%');
            }

            $brands = $query->get();

            return $this->apiResponse->success($brands, 'Brands fetched successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch brands', 500);
        }
    }

    public function updateBrand(Request $request, $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('brands_models')->where(function ($query) use ($request) {
                        return $query->where('sub_cat_id', $request->input('sub_cat_id'));
                    })->ignore($id)
                ],
                'status' => 'required|in:0,1',
                'brandid' => 'nullable|integer',
                'sub_cat_id' => 'nullable|integer|exists:categories,id',
            ]);

            $brand = BrandsModels::findOrFail($id);

            $category = Category::find($validated['sub_cat_id'] ?? $brand->sub_cat_id);

            $url = strtolower($category->name . ' ' . $validated['name']);
            $url = preg_replace('/[^a-z0-9\-]/', ' ', $url);
            $url = preg_replace('/\s+/', '-', $url);

            $brand->name = $validated['name'];
            $brand->url = $url;
            $brand->brandsId = $request->input('brandid', 0);
            $brand->sub_cat_id = $validated['sub_cat_id'] ?? $brand->sub_cat_id;
            $brand->status = $validated['status'];
            $brand->save();

            return $this->apiResponse->success($brand, 'Brand updated successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to update brand', 500);
        }
    }

    public function deleteBrandByUrl($url): JsonResponse
    {
        try {
            $brand = BrandsModels::where('url', $url)->first();

            if (!$brand) {
                return $this->apiResponse->error('Brand not found', 'No brand with given URL', 404);
            }

            $brand->delete();
            return $this->apiResponse->success(null, 'Brand deleted successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to delete brand', 500);
        }
    }

    public function getModelsByBrand($url): JsonResponse
    {
        try {
            $brand = BrandsModels::where('url', $url)->select('id', 'url', 'name', 'status')->first();

            if (!$brand) {
                return $this->apiResponse->error('Brand not found', 'No brand with this URL', 404);
            }

            $models = BrandsModels::where('brandsId', $brand->id)
                ->select('id', 'url', 'name', 'status')
                ->get();

            return $this->apiResponse->success([
                'brand' => $brand,
                'models' => $models,
            ], 'Brand models fetched successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch models', 500);
        }
    }
}
