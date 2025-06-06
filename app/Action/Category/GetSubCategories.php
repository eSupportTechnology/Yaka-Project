<?php

namespace App\Action\Category;

use App\Models\Category;
use App\Services\ApiResponseService;

class GetSubCategories
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function __invoke($categoryId)
    {
        try {
            $category = Category::findOrFail($categoryId);

            $subCategories = $category->subcategories;

            if ($subCategories->isEmpty()) {
                return $this->apiResponse->error('No subcategories found', 'Subcategories not found', 404);
            }

            return $this->apiResponse->success($subCategories, 'Subcategories fetched successfully');

        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch sub-categories', 500);
        }
    }
}
