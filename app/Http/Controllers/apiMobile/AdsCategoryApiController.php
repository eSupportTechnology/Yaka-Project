<?php

namespace App\Http\Controllers\apiMobile;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Banners;
use App\Models\BrandsModels;
use App\Services\ApiResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdsCategoryApiController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function browseAdsApi(Request $request)
    {
        try {
            $category = $request->query('category');
            $subcategory = $request->query('subcategory');
            $searchTerm = $request->query('search');

            $query = Ads::with(['user', 'main_location', 'sub_location', 'category', 'subcategory'])
                ->where('status', 1)
                ->where(function ($q) {
                    $q->whereNull('package_expire_at')
                        ->orWhere('package_expire_at', '>=', Carbon::now());
                });

            if (!empty($category)) {
                $query->where('cat_id', $category);
            }

            if (!empty($subcategory)) {
                $query->where('sub_cat_id', $subcategory);
            }

            if (!empty($searchTerm)) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('description', 'like', "%{$searchTerm}%");
                });
            }

            $perPage = (int)$request->query('per_page', 30);
            $page = (int)$request->query('page', 1);

            $ads = $query->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);

            // Map over ads items to add posted_by details
            $itemsWithPostedBy = collect($ads->items())->map(function ($ad) {
                return array_merge($ad->toArray(), [
                    'posted_by' => [
                        'name' => trim(($ad->user->first_name ?? '') . ' ' . ($ad->user->last_name ?? '')),
                        'email' => $ad->user->email ?? 'N/A',
                        'phone' => $ad->user->phone_number ?? 'N/A',
                    ],
                ]);
            });

            $responseData = [
                'items' => $itemsWithPostedBy,
                'meta'  => [
                    'current_page' => $ads->currentPage(),
                    'last_page' => $ads->lastPage(),
                    'per_page' => $ads->perPage(),
                    'total' => $ads->total(),
                ],
            ];

            return $this->apiResponse->success($responseData, 'Ads fetched successfully');

        } catch (\Exception $e) {
            Log::error('Error fetching ads: '.$e->getMessage());

            return $this->apiResponse->error(null, 'Failed to fetch ads', 500);
        }
    }

    public function searchApi(Request $request, ApiResponseService $apiResponse)
    {
        $query = $request->input('query');

        if (!$query) {
            return $apiResponse->error(null, 'Please enter a search term.', 422);
        }

        try {
            $ads = Ads::with(['category', 'subcategory', 'main_location'])
                ->where('status', '1')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhereHas('category', function ($q) use ($query) {
                            $q->where('name', 'like', "%{$query}%");
                        })
                        ->orWhereHas('subcategory', function ($q) use ($query) {
                            $q->where('name', 'like', "%{$query}%");
                        });
                })
                ->get();

            return $apiResponse->success($ads, 'Search results retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());

            return $apiResponse->error(null, 'Failed to perform search', 500);
        }
    }

    public function apiShowDetails($adsId)
    {
        $ad = Ads::where('adsId', $adsId)
            ->with(['main_location', 'sub_location', 'user', 'category'])
            ->firstOrFail();

        $brand = BrandsModels::find($ad->brand);
        $model = BrandsModels::find($ad->model);
        $subImages = json_decode($ad->subImage, true);
        $ad->view_count += 1;
        $ad->save();

        $banners = Banners::where('type', 0)->get();
        $otherbanners = Banners::where('type', 1)->get();

        $relatedAds = Ads::where('adsId', '!=', $ad->adsId)
            ->where(function ($query) use ($ad) {
                $query->where('cat_id', $ad->cat_id)
                    ->where('sub_cat_id', $ad->sub_cat_id)
                    ->where('location', $ad->location);
            })
            ->where(function ($query) {
                $query->whereNull('package_expire_at')
                    ->orWhere('package_expire_at', '>=', Carbon::now());
            })
            ->latest()
            ->take(12)
            ->get();

        // Fetch additional ads if related ads are less than 12 (same as your current logic)
        if ($relatedAds->count() < 12) {
            $additionalAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where(function ($query) use ($ad) {
                    $query->where('cat_id', $ad->cat_id)
                        ->where('sub_cat_id', $ad->sub_cat_id);
                })
                ->latest()
                ->take(12 - $relatedAds->count())
                ->get();
            $relatedAds = $relatedAds->merge($additionalAds);
        }
        if ($relatedAds->count() < 12) {
            $additionalAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where(function ($query) use ($ad) {
                    $query->where('cat_id', $ad->cat_id)
                        ->where('location', $ad->location);
                })
                ->latest()
                ->take(12 - $relatedAds->count())
                ->get();
            $relatedAds = $relatedAds->merge($additionalAds);
        }
        if ($relatedAds->count() < 12) {
            $additionalAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where('cat_id', $ad->cat_id)
                ->latest()
                ->take(12 - $relatedAds->count())
                ->get();
            $relatedAds = $relatedAds->merge($additionalAds);
        }
        if ($relatedAds->count() < 12) {
            $additionalAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where('location', $ad->location)
                ->latest()
                ->take(12 - $relatedAds->count())
                ->get();
            $relatedAds = $relatedAds->merge($additionalAds);
        }

        return response()->json([
            'ad' => $ad,
            'brand' => $brand,
            'model' => $model,
            'mainImage' => $ad->mainImage,
            'subImages' => $subImages,
            'banners' => $banners,
            'otherbanners' => $otherbanners,
            'relatedAds' => $relatedAds,
        ]);
    }
}
