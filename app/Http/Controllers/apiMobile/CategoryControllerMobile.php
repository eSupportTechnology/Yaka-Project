<?php

namespace App\Http\Controllers\apiMobile;

use App\Models\Ads;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Cache;

class CategoryControllerMobile extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Get all categories for mobile app
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCategories()
    {
        try {
            $categories = Category::where('status', 1)
                ->where('mainId', 0)
                ->withCount(['ads' => function ($query) {
                    $query->where('status', 1);
                }])
                ->get()
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'url' => $category->url,
                        'image_url' => $category->image ? asset('images/Category/' . $category->image) : null,
                        'ads_count' => $category->ads_count,
                    ];
                });

            return $this->apiResponse->success($categories, 'Categories fetched successfully');
        } catch (\Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch categories', 500);
        }
    }

    /**
     * Get subcategories for a specific category
     *
     * @param int $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubcategories($categoryId)
    {
        try {
            $subcategories = Category::where('status', 1)
                ->where('mainId', $categoryId)
                ->withCount(['ads' => function ($query) {
                    $query->where('status', 1);
                }])
                ->get()
                ->map(function ($subcategory) {
                    return [
                        'id' => $subcategory->id,
                        'name' => $subcategory->name,
                        'url' => $subcategory->url,
                        'image_url' => $subcategory->image ? asset('images/SubCategory/' . $subcategory->image) : null,
                        'ads_count' => $subcategory->ads_count,
                    ];
                });

            return $this->apiResponse->success($subcategories, 'Subcategories fetched successfully');
        } catch (\Exception $e) {
            Log::error('Error fetching subcategories: ' . $e->getMessage());
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch subcategories', 500);
        }
    }

    /**
     * Get category browse data with filters
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryBrowseData(Request $request)
    {
        try {
            $startTime = microtime(true);
            
            // Get and validate query parameters
            $categoryId = $request->query('category_id') ? (int)$request->query('category_id') : null;
            $subCategoryId = $request->query('subcategory_id') ? (int)$request->query('subcategory_id') : null;
            $searchTerm = trim($request->query('search'));
            $page = max(1, (int)$request->query('page', 1));
            $perPage = min(50, max(5, (int)$request->query('per_page', 20)));

            // Build response data array
            $responseData = [];

            // Cache categories data (relatively static)
            $cacheKey = 'mobile_categories_v2';
            $responseData['categories'] = Cache::remember($cacheKey, now()->addHours(6), function () {
                Log::info('Categories cache miss - regenerating');
                return Category::where('status', 1)
                    ->where('mainId', 0)
                    ->select('id', 'name', 'url', 'image') // Only select needed fields
                    ->withCount(['ads' => function ($query) {
                        $query->where('status', 1);
                    }])
                    ->get()
                    ->map(function ($category) {
                        return [
                            'id' => $category->id,
                            'name' => $category->name,
                            'url' => $category->url,
                            'image_url' => $category->image ? asset('images/Category/' . $category->image) : null,
                            'ads_count' => $category->ads_count,
                        ];
                    });
            });

            // Process selected category (with cache)
            if ($categoryId) {
                $catCacheKey = 'category_details_' . $categoryId;
                $selectedCategory = Cache::remember($catCacheKey, now()->addHours(6), function () use ($categoryId) {
                    Log::info('Category details cache miss - regenerating', ['category_id' => $categoryId]);
                    return Category::select('id', 'name', 'url', 'image')->find($categoryId);
                });
                
                if (!$selectedCategory) {
                    Log::warning('Invalid category ID provided', ['category_id' => $categoryId]);
                    return $this->apiResponse->error(
                        'Category not found', 
                        'The requested category does not exist', 
                        404
                    );
                }

                $responseData['selected_category'] = [
                    'id' => $selectedCategory->id,
                    'name' => $selectedCategory->name,
                    'url' => $selectedCategory->url,
                    'image_url' => $selectedCategory->image ? asset('images/Category/' . $selectedCategory->image) : null,
                ];
                
                // Cache subcategories for selected category (relatively static)
                $subCatCacheKey = 'subcategories_' . $categoryId . '_v2';
                $responseData['subcategories'] = Cache::remember($subCatCacheKey, now()->addHours(6), function () use ($categoryId) {
                    Log::info('Subcategories cache miss - regenerating', ['category_id' => $categoryId]);
                    return Category::where('status', 1)
                        ->where('mainId', $categoryId)
                        ->select('id', 'name', 'url', 'image') // Only select needed fields
                        ->withCount(['ads' => function ($query) {
                            $query->where('status', 1);
                        }])
                        ->get()
                        ->map(function ($subcategory) {
                            return [
                                'id' => $subcategory->id,
                                'name' => $subcategory->name,
                                'url' => $subcategory->url,
                                'image_url' => $subcategory->image ? asset('images/SubCategory/' . $subcategory->image) : null,
                                'ads_count' => $subcategory->ads_count,
                            ];
                        });
                });
            }
            
            // Validate subcategory (with cache)
            if ($subCategoryId) {
                $subCatDetailCacheKey = 'subcategory_details_' . $subCategoryId;
                $selectedSubcategory = Cache::remember($subCatDetailCacheKey, now()->addHours(6), function () use ($subCategoryId) {
                    Log::info('Subcategory details cache miss - regenerating', ['subcategory_id' => $subCategoryId]);
                    return Category::select('id', 'name', 'url', 'image', 'mainId')->find($subCategoryId);
                });
                
                if (!$selectedSubcategory) {
                    Log::warning('Invalid subcategory ID provided', ['subcategory_id' => $subCategoryId]);
                    return $this->apiResponse->error(
                        'Subcategory not found', 
                        'The requested subcategory does not exist', 
                        404
                    );
                }
                
                // Verify subcategory relationship with category if both provided
                if ($categoryId && $selectedSubcategory->mainId != $categoryId) {
                    Log::warning('Subcategory does not belong to the selected category', [
                        'category_id' => $categoryId,
                        'subcategory_id' => $subCategoryId,
                        'parent_id' => $selectedSubcategory->mainId
                    ]);
                    return $this->apiResponse->error(
                        'Invalid subcategory', 
                        'The specified subcategory does not belong to the selected category', 
                        400
                    );
                }
                
                $responseData['selected_subcategory'] = [
                    'id' => $selectedSubcategory->id,
                    'name' => $selectedSubcategory->name,
                    'url' => $selectedSubcategory->url,
                    'image_url' => $selectedSubcategory->image ? asset('images/SubCategory/' . $selectedSubcategory->image) : null,
                ];
            }

            // NO CACHING for ads - always fetch in real-time
            // Base query for active, non-expired ads with optimized column selection

            $baseQuery = Ads::select(
                    'adsId', 'title', 'description', 'price', 'mainImage', 'subImage',
                    'price_type', 'post_type', 'condition', 'ads_package', 'cat_id', 'sub_cat_id',
                    'created_at', 'updated_at', 'view_count', 'user_id'
                )
                ->where('status', 1)
                ->where(function($query) {
                    $query->whereNull('package_expire_at')
                          ->orWhere('package_expire_at', '>=', now());
                });
                
            // Apply filters
            if ($categoryId) {
                $baseQuery->where('cat_id', $categoryId);
            }
            
            if ($subCategoryId) {
                $baseQuery->where('sub_cat_id', $subCategoryId);
            }
            
            if (!empty($searchTerm)) {
                $baseQuery->where(function($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                          ->orWhere('description', 'like', "%{$searchTerm}%");
                });
                
                $responseData['search_term'] = $searchTerm;
            }

            // Get different types of ads in priority order - REAL TIME fetching 
            // 1. Super Ads (highest priority)
            $superAds = (clone $baseQuery)
                ->with(['category:id,name', 'subcategory:id,name', 'user:id,name,phone_number'])
                ->where('ads_package', 6)
                ->latest()
                ->limit(10)
                ->get();
            $responseData['super_ads'] = $this->formatAdsForResponse($superAds);
            
            // 2. Top Ads
            $topAds = (clone $baseQuery)
                ->with(['category:id,name', 'subcategory:id,name', 'user:id,name,phone_number'])
                ->where('ads_package', 3)
                ->latest()
                ->limit(10)
                ->get();
            $responseData['top_ads'] = $this->formatAdsForResponse($topAds);
            
            // 3. Urgent Ads
            $urgentAds = (clone $baseQuery)
                ->with(['category:id,name', 'subcategory:id,name', 'user:id,name,phone_number'])
                ->where('ads_package', 5)
                ->latest()
                ->limit(10)
                ->get();
            $responseData['urgent_ads'] = $this->formatAdsForResponse($urgentAds);
            
            // 4. Jump Up Ads
            $jumpUpAds = (clone $baseQuery)
                ->with(['category:id,name', 'subcategory:id,name', 'user:id,name,phone_number'])
                ->where('ads_package', 4)
                ->latest()
                ->limit(10)
                ->get();
            $responseData['jump_up_ads'] = $this->formatAdsForResponse($jumpUpAds);

            // All ads with proper ordering - REAL TIME (no cache)
            $allAdsQuery = (clone $baseQuery)
                ->with(['category:id,name', 'subcategory:id,name', 'user:id,name,phone_number'])
                ->orderByRaw('CASE 
                    WHEN ads_package = 6 THEN 1  -- Super ads
                    WHEN ads_package = 3 THEN 2  -- Top ads
                    WHEN ads_package = 5 THEN 3  -- Urgent ads
                    WHEN ads_package = 4 THEN 4  -- Jump up ads
                    ELSE 5
                END')
                ->latest();
            
            // Apply pagination
            $ads = $allAdsQuery->paginate($perPage, ['*'], 'page', $page);
            
            // Format ads while preserving pagination metadata
            $formattedAds = $ads->through(function ($ad) {
                return $this->formatAdForResponse($ad);
            });
            
            $responseData['ads'] = $formattedAds;
            $responseData['total_ads_count'] = $ads->total();
            
            // Performance metrics
            $executionTime = round((microtime(true) - $startTime) * 1000, 2);
            Log::info('Category browse data fetched successfully', [
                'category_id' => $categoryId,
                'subcategory_id' => $subCategoryId,
                'search' => $searchTerm,
                'ads_count' => $ads->total(),
                'execution_time_ms' => $executionTime
            ]);
            
            return $this->apiResponse->success($responseData, 'Category browse data fetched successfully');
            
        } catch (\Exception $e) {
            Log::error('Error fetching category browse data: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'category_id' => $request->query('category_id'),
                'subcategory_id' => $request->query('subcategory_id'),
                'search' => $request->query('search')
            ]);
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch category browse data', 500);
        }
    }
    
    /**
     * Format an ad for the API response
     *
     * @param Ads $ad
     * @return array
     */
    private function formatAdForResponse($ad)
    {
        // Format the main image URL with storage path
        $mainImageUrl = $ad->mainImage ? asset('storage/' . $ad->mainImage) : null;
        
        // Format sub images
        $subImages = [];
        if ($ad->subImage) {
            $subImagesArray = json_decode($ad->subImage, true);
            if (is_array($subImagesArray)) {
                foreach ($subImagesArray as $subImage) {
                    $subImages[] = asset('storage/' . $subImage);
                }
            }   
        }
        
        // Add package type name based on ads_package value
        $packageName = 'Regular Ad';
        switch($ad->ads_package) {
            case 6:
                $packageName = 'Super Ad';
                break;
            case 3:
                $packageName = 'Top Ad';
                break;
            case 5:
                $packageName = 'Urgent Ad';
                break;
            case 4:
                $packageName = 'Jump Up Ad';
                break;
        }
        
        return [
            'id' => $ad->adsId,
            'ads_id' => $ad->adsId,
            'title' => $ad->title,
            'price' => $ad->price,
            'description' => $ad->description,
            'main_image' => $mainImageUrl,
            'sub_images' => $subImages,
            'price_type' => $ad->price_type,
            'post_type' => $ad->post_type,
            'condition' => $ad->condition,
            'package' => [
                'id' => $ad->ads_package,
                'name' => $packageName
            ],
            'category' => $ad->category ? [
                'id' => $ad->category->id,
                'name' => $ad->category->name
            ] : null,
            'subcategory' => $ad->subcategory ? [
                'id' => $ad->subcategory->id,
                'name' => $ad->subcategory->name
            ] : null,
            'user' => $ad->user ? [
                'id' => $ad->user->id,
                'name' => $ad->user->name,
                'phone' => $ad->user->phone_number
            ] : null,
            'created_at' => $ad->created_at,
            'updated_at' => $ad->updated_at,
            'view_count' => $ad->view_count ?? 0,
        ];
    }
    
    /**
     * Format a collection of ads for the API response
     *
     * @param \Illuminate\Database\Eloquent\Collection $ads
     * @return array
     */
    private function formatAdsForResponse($ads)
    {
        return $ads->map(function($ad) {
            return $this->formatAdForResponse($ad);
        })->toArray();
    }
    
    /**
     * Get ad details with related ads
     * 
     * @param string $adsId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAdDetails($adsId)
    {
        try {
            // Fetch the ad details with eager loading for the related data
            $ad = Ads::where('adsId', $adsId)
                     ->with([
                         'user', 
                         'category', 
                         'subcategory',
                         'brand',
                         'model'
                     ])
                     ->first();

            if (!$ad) {
                return $this->apiResponse->error(
                    'Ad not found', 
                    'The requested ad does not exist', 
                    404
                );
            }

            // Increment view count
            $ad->increment('view_count');

            // Format main image and sub images
            $mainImageUrl = $ad->mainImage ? asset('storage/' . $ad->mainImage) : null;
            $subImages = [];
            if ($ad->subImage) {
                $subImagesArray = json_decode($ad->subImage, true);
                if (is_array($subImagesArray)) {
                    foreach ($subImagesArray as $subImage) {
                        $subImages[] = asset('storage/' . $subImage);
                    }
                }
            }

            // Format the ad details
            $adDetails = [
                'id' => $ad->adsId,
                'ads_id' => $ad->adsId,
                'title' => $ad->title,
                'description' => $ad->description,
                'price' => $ad->price,
                'price_type' => $ad->price_type,
                'post_type' => $ad->post_type,
                'condition' => $ad->condition,
                'main_image' => $mainImageUrl,
                'sub_images' => $subImages,
                'view_count' => $ad->view_count,
                'created_at' => $ad->created_at,
                'updated_at' => $ad->updated_at,
                'category' => $ad->category ? [
                    'id' => $ad->category->id,
                    'name' => $ad->category->name
                ] : null,
                'subcategory' => $ad->subcategory ? [
                    'id' => $ad->subcategory->id,
                    'name' => $ad->subcategory->name
                ] : null,
                'user' => $ad->user ? [
                    'id' => $ad->user->id,
                    'name' => $ad->user->name,
                    'phone' => $ad->user->phone_number
                ] : null,
                'brand' => $ad->brand ? [
                    'id' => $ad->brand->id,
                    'name' => $ad->brand->name
                ] : null,
                'model' => $ad->model ? [
                    'id' => $ad->model->id,
                    'name' => $ad->model->name
                ] : null,
            ];

            // Fetch related ads using simplified logic (without location filtering)
            $relatedAds = Ads::where('adsId', '!=', $ad->adsId)
                ->where(function ($query) use ($ad) {
                    $query->where('cat_id', $ad->cat_id)
                          ->where('sub_cat_id', $ad->sub_cat_id);
                })
                ->where('status', 1)
                ->latest()
                ->take(12)
                ->get();

            if ($relatedAds->count() < 12) {
                $additionalAds = Ads::where('adsId', '!=', $ad->adsId)
                    ->where('cat_id', $ad->cat_id)
                    ->where('status', 1)
                    ->latest()
                    ->take(12 - $relatedAds->count())
                    ->get();
                $relatedAds = $relatedAds->merge($additionalAds);
            }

            // Format related ads
            $formattedRelatedAds = $relatedAds->map(function($relatedAd) {
                return [
                    'id' => $relatedAd->adsId,
                    'ads_id' => $relatedAd->adsId,
                    'title' => $relatedAd->title,
                    'price' => $relatedAd->price,
                    'main_image' => $relatedAd->mainImage ? asset('storage/' . $relatedAd->mainImage) : null,
                    'price_type' => $relatedAd->price_type,
                    'condition' => $relatedAd->condition,
                    'created_at' => $relatedAd->created_at,
                ];
            });

            $responseData = [
                'ad_details' => $adDetails,
                'related_ads' => $formattedRelatedAds,
                'related_ads_count' => $relatedAds->count()
            ];

            Log::info('Ad details fetched successfully', [
                'ads_id' => $adsId,
                'related_ads_count' => $relatedAds->count()
            ]);

            return $this->apiResponse->success($responseData, 'Ad details fetched successfully');

        } catch (\Exception $e) {
            Log::error('Error fetching ad details: ' . $e->getMessage(), [
                'ads_id' => $adsId,
                'trace' => $e->getTraceAsString()
            ]);
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch ad details', 500);
        }
    }
}

