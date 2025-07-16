<?php

use App\Http\Controllers\adminPanel\subCategoriesManagementController;
use App\Http\Controllers\apiMobile\AdminUserController;
use App\Http\Controllers\apiMobile\AdsApiController;
use App\Http\Controllers\apiMobile\BrandApiController;
use App\Http\Controllers\apiMobile\CategoryApiController;
use App\Http\Controllers\apiMobile\PackageApiController;
use App\Http\Controllers\apiMobile\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AdsController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\BoostingController;
use App\Http\Controllers\api\AdPostController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\LocattionController;
use App\Http\Controllers\api\BrandsModelsController;
use App\Http\Controllers\apiMobile\AdsControllerMobile;
use App\Http\Controllers\apiMobile\AdminAdsApiController;
use App\Http\Controllers\apiMobile\AdminApprovalApiController;
use App\Http\Controllers\apiMobile\AdminAuthController;
use App\Http\Controllers\apiMobile\AdminBannerApiController;
use App\Http\Controllers\apiMobile\AdminBannerCreationController;
use App\Http\Controllers\apiMobile\AdminBannerPackageApiController;
use App\Http\Controllers\apiMobile\AdminCategoryApiController;
use App\Http\Controllers\apiMobile\AdminDashboardApiController;
use App\Http\Controllers\apiMobile\AdminTypeApiController;
use App\Http\Controllers\apiMobile\AdminUsersApiController;
use App\Http\Controllers\apiMobile\AuthControllerMobile;
use App\Http\Controllers\apiMobile\CommonControllerMobile;
use App\Http\Controllers\apiMobile\CategoryControllerMobile;
use App\Http\Controllers\apiMobile\HomepageControllerMobile;
use App\Http\Controllers\frontend\PaymentProcessingController;
use App\Http\Controllers\adminPanel\dashboardController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//

Route::get('/ping', function () {
    return response()->json([
        'message' => 'API is working!',
        'status' => 'success'
    ]);
});

Route::post('/login', [AuthControllerMobile::class, 'mobileLogin']);
Route::post('/logout', [AuthControllerMobile::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthControllerMobile::class, 'register']);

//
Route::post('/ads/search', [AdsControllerMobile::class, 'searchByTitle']);

//
Route::post('/payment/notify',[PaymentProcessingController::class , 'getPaymentInfo']);

// Payament ad boost
Route::post('/payment/boostnotify',[BoostingController::class , 'updateBoost']);

// Top and Bottom banners endpoint (regular banners)
Route::get('/banners/top-bottom', [HomepageControllerMobile::class, 'getTopBottomBanners']);
// Super Ads banners endpoint
Route::get('/banners/super-ads', [HomepageControllerMobile::class, 'getSuperAdsBanners']);
// Top Ads banners endpoint
Route::get('/banners/top-ads', [HomepageControllerMobile::class, 'getTopAdsBanners']);

// Super Ads endpoint
Route::get('/super-ads', [HomepageControllerMobile::class, 'getSuperAds']);
// Top Ads endpoint
Route::get('/top-ads', [HomepageControllerMobile::class, 'getTopAds']);
// Latest Ads endpoint
Route::get('/latest-ads', [HomepageControllerMobile::class, 'getLatestAds']);
//Get all categories endpoint
Route::get('/home-categories', [HomepageControllerMobile::class, 'getCategories']);


// Home Page Ads endpoint
Route::get('/home-page-ads', [HomepageControllerMobile::class, 'getHomePageAds']);

Route::get('/category/{categoryId}/subcategories', [subCategoriesManagementController::class, 'getSubCategoriesByCategoryId']);

Route::middleware('auth:api')->group(function () {

});

// Admin API Authentication Routes
Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth:sanctum');

    // Group all protected admin routes with auth:api middleware
    Route::middleware('auth:api')->group(function () {
        // Dashboard chart routes
        Route::get('/dashboard/users-chart', [dashboardController::class, 'fetchChartData']);
        Route::get('/dashboard/paid-ads-chart', [dashboardController::class, 'fetchChartDataPaidAd']);
        Route::get('/dashboard/free-ads-chart', [dashboardController::class, 'fetchChartDataFreeAd']);

        // Combined charts endpoint
        Route::get('/dashboard/all-charts', [dashboardController::class, 'apiCharts']);

        // Admin dashboard stats endpoint for ads counts
        Route::get('/dashboard/ads-counts', [AdminDashboardApiController::class, 'getAdsCounts']);

        // Admin ads management API endpoints
        Route::get('/ads-list', [AdminAdsApiController::class, 'getAdsList']);
        Route::post('/update-ad-status', [AdminAdsApiController::class, 'updateAdStatus']);

        // Admin users management API endpoint
        Route::get('/users-list', [AdminUsersApiController::class, 'getUsersList']);

        // Admin users management API endpoint - specifically for admins
        Route::get('/admins-list', [AdminUsersApiController::class, 'getAdminsList']);

        // Endpoint to create admin users
        Route::post('/create-admin', [AdminUsersApiController::class, 'createAdmin']);

        // Admin categories management API endpoints
        Route::get('/categories-list', [AdminCategoryApiController::class, 'getCategories']);
        Route::post('/categories', [AdminCategoryApiController::class, 'storeCategory']);

        // Admin staff management API endpoint
        Route::get('/staff-list', [AdminUsersApiController::class, 'getStaffList']);
        Route::post('/create-staff', [AdminUsersApiController::class, 'createStaff']);
        Route::put('/update-staff', [AdminUsersApiController::class, 'updateStaff']);
        // New endpoint for deleting staff members
        Route::delete('/delete-staff', [AdminUsersApiController::class, 'deleteStaff']);

        // Ad approval endpoint
        Route::post('/approve-ad', [AdminApprovalApiController::class, 'approveAd']);

        // Ad disapproval endpoint
        Route::post('/disapprove-ad', [App\Http\Controllers\apiMobile\AdminDisapprovalApiController::class, 'disapproveAd']);

        // Admin banner management API endpoint
        Route::get('/banners-list', [AdminBannerApiController::class, 'getBannersList']);

        // Admin banner creation endpoint
        Route::post('/create-banner', [AdminBannerCreationController::class, 'createBanner']);

        // Admin banner packages management API endpoint
        Route::get('/banner-packages-list', [AdminBannerPackageApiController::class, 'getBannerPackagesList']);

        // Admin banner package creation endpoint
        Route::post('/create-banner-package', [App\Http\Controllers\apiMobile\AdminBannerPackageCreateController::class, 'createBannerPackage']);

        // Admin brands management API endpoints
        Route::get('/brands-list', [App\Http\Controllers\apiMobile\AdminBrandApiController::class, 'getBrandsList']);
        Route::get('/brands/{brandId}/models', [App\Http\Controllers\apiMobile\AdminBrandApiController::class, 'getBrandModels']);

        // Admin packages management API endpoint
        Route::get('/packages-list', [App\Http\Controllers\apiMobile\AdminPackageApiController::class, 'getPackagesList']);

        // Admin types management API endpoint
        Route::get('/types-list', [AdminTypeApiController::class, 'getTypesList']);

        // New endpoint for creating types
        Route::post('/create-type', [AdminTypeApiController::class, 'createType']);
    });
});

Route::put('/admin-update/{id}', [AdminUserController::class, 'updateAdmin']);
Route::delete('/admin-delete/{id}', [AdminUserController::class, 'deleteAdmin']);

Route::put('/user-update/{id}', [UserApiController::class, 'updateUser']);
Route::delete('/user-delete/{id}', [UserApiController::class, 'deleteUser']);
Route::get('/user-phone/{number}', [UserApiController::class, 'findByPhoneUser']);

Route::put('/categories-update/{url}', [CategoryApiController::class, 'updateCategories']);
Route::delete('/categories-delete/{url}', [CategoryApiController::class, 'deleteCategories']);

Route::get('/ads-search', [AdsApiController::class, 'adsSearch']);

Route::get('/brands-search', [BrandApiController::class, 'searchBrands']);
Route::put('/brand-update/{id}', [BrandApiController::class, 'updateBrand']);
Route::delete('/brand-delete/{url}', [BrandApiController::class, 'deleteBrandByUrl']);
Route::get('/brand-model/{url}/models', [BrandApiController::class, 'getModelsByBrand']);

Route::put('/package-update/{url}', [PackageApiController::class, 'packageUpdate']);
Route::delete('/package-delete/{url}', [PackageApiController::class, 'packageDelete']);
/**
 * Public route API
 */
Route::post('/send/verification-code', [AuthControllerMobile::class, 'SendMobileVerificationCode']); // Send Verification Code
Route::post('/verify/registration-otp', [AuthControllerMobile::class, 'verifyRegistrationOtp']); // Verify Registration OTP

Route::get('/get/districts', [CommonControllerMobile::class, 'getDistricts']); // Get all districts or a district with cities using district_id query param

/**
 * Ad Post routes
 */











