<?php

namespace App\Action\Category;

use App\Models\Category;
use App\Services\CommonResponse;

class GetSubCategories
{
    public function __invoke($categoryId)
    {
        try {
            $category = Category::findOrFail($categoryId);

            $subCategories = $category->subcategories;

            if ($subCategories->isEmpty()) {
                return CommonResponse::getNotFoundResponse('subcategories');
            }

            return CommonResponse::sendSuccessResponseWithData('subcategories', $subCategories);

        } catch (\Exception $e) {
            return CommonResponse::sendBadResponseWithMessage('Failed to fetch sub-categories: ' . $e->getMessage());
        }
    }
}
