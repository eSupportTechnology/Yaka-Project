<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AdsController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\AdPostController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\LocattionController;
use App\Http\Controllers\api\BrandsModelsController;
use App\Http\Controllers\frontend\PaymentProcessingController;
use App\Http\Controllers\BoostingController;

use App\Http\Controllers\apiMobile\AdsControllerMobile;
use App\Http\Controllers\apiMobile\AuthControllerMobile;
use App\Http\Controllers\apiMobile\CategoryControllerMobile;
use App\Http\Controllers\apiMobile\HomepageControllerMobile;




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


Route::get('/categories', [CategoryControllerMobile::class, 'getAllCategories']);


Route::post('/ads/search', [AdsControllerMobile::class, 'searchByTitle']);



// Payament info
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

Route::middleware('auth:api')->group(function () {

});

/**
 * Public route API
 */
Route::get('/send/verification-code', [AuthControllerMobile::class, 'SendMobileVerificationCode']); // Send Verification Code
Route::get('/verify/registration-otp', [AuthControllerMobile::class, 'verifyRegistrationOtp']); // Verify Registration OTP








