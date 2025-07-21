<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\AdsTypes;
use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Services\ApiResponseService;

class AdsTypeApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function updateAddType(Request $request, $url): JsonResponse
    {
        try {
            $adsType = AdsTypes::where('url', $url)->first();

            if (!$adsType) {
                return $this->apiResponse->error('Ads type not found', 'No ads type found with the given URL', 404);
            }

            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    "regex:/^[^\?\/\[\]{}\-,.<>:;'|!`~()&%$#@*\^]*$/",
                    Rule::unique('table_ad_types')->where('catergoryId', $request['sub_cat_id'])->ignore($adsType->id)
                ],
                'status' => 'required|in:0,1',
                'sub_cat_id' => 'required|exists:categories,id'
            ]);

            $category = Category::find($request['sub_cat_id']);
            if (!$category) {
                return $this->apiResponse->error('Category not found', 'Invalid subcategory ID', 404);
            }
            $generatedUrl = strtolower($category->name . ' ' . $validated['name']);
            $generatedUrl = preg_replace('/[^a-z0-9\-]/', ' ', $generatedUrl);
            $generatedUrl = preg_replace('/\s+/', '-', $generatedUrl);

            $adsType->name = $validated['name'];
            $adsType->url = $generatedUrl;
            $adsType->status = $validated['status'];
            $adsType->catergoryId = $request['sub_cat_id'];
            $adsType->save();

            return $this->apiResponse->success($adsType, 'Ads type updated successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to update ads type', 500);
        }
    }

    public function deleteAddType($url): JsonResponse
    {
        try {
            $adsType = AdsTypes::where('url', $url)->first();

            if (!$adsType) {
                return $this->apiResponse->error('Ads type not found', 'No ads type found with the given URL', 404);
            }

            $adsType->delete();

            return $this->apiResponse->success(null, 'Ads type deleted successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to delete ads type', 500);
        }
    }
}
