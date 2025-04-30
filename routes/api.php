<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AdsController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\AdPostController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\LocattionController;
use App\Http\Controllers\api\SubCategoryController;
use App\Http\Controllers\api\BrandsModelsController;
use App\Http\Controllers\frontend\PaymentProcessingController;
//use App\Http\Controllers\api\CategoryController;
//use App\Http\Controllers\api\SubCategoryController;

//before
// use App\Http\Controllers\apiMobile\AdsController;
// use App\Http\Controllers\apiMobile\AuthController;
// use App\Http\Controllers\apiMobile\CategoryController;


//update fix
// change Controllers Name
use App\Http\Controllers\apiMobile\AdsControllerMobile; 
use App\Http\Controllers\apiMobile\AuthControllerMobile;
use App\Http\Controllers\apiMobile\CategoryControllerMobile;




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

/*
//AuthController
Route::post('/user/register',[AuthController::class ,'createUser']);
Route::post('/user/login',[AuthController::class ,'loginUser']);

//CategoryController
Route::get('/main-categories/',[CategoryController::class , 'index']);

//SubCategoryController
Route::get('/sub-categories/{category}',[SubCategoryController::class ,'index']);

//AdsController
Route::get('/ads/{category}/{district?}',[AdsController::class , 'index']);
Route::get('/all-ads/{paginate}',[AdsController::class , 'AllAds']);
Route::post('/ads',[AdsController::class , 'filter']);
Route::post('/ads/post',[AdPostController::class , 'mainAdsPost']);

//BrandsModelsController
Route::get('/brands/{category}',[BrandsModelsController::class , 'GetBrands']);
Route::get('/models/{brands}',[BrandsModelsController::class , 'GetModels']);

//LocationController
Route::get('/province',[LocattionController::class , 'GetProvince']);
Route::get('/districts',[LocattionController::class , 'GetDistrict']);
Route::get('/city/{district}',[LocattionController::class , 'GetCity']);
*/

Route::get('/ping', function () {
    return response()->json([
        'message' => 'API is working!',
        'status' => 'success'
    ]);
});

Route::post('/login', [AuthControllerMobile::class, 'login']);
Route::post('/logout', [AuthControllerMobile::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthControllerMobile::class, 'register']);


Route::get('/categories', [CategoryControllerMobile::class, 'getAllCategories']);


Route::post('/ads/search', [AdsControllerMobile::class, 'searchByTitle']);



// Payament info
Route::post('/payment/notify',[PaymentProcessingController::class , 'getPaymentInfo']);








