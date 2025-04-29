<?php

use App\Http\Controllers\api\AdPostController;
use App\Http\Controllers\api\BrandsModelsController;
use App\Http\Controllers\api\LocattionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\SubCategoryController;
use App\Http\Controllers\apiMobile\AdsController;
use App\Http\Controllers\apiMobile\AuthController;
use App\Http\Controllers\apiMobile\CategoryController;
use App\Http\Controllers\apiMobile\UserController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/categories', [CategoryController::class, 'getAllCategories']);


Route::post('/ads/search', [AdsController::class, 'searchByTitle']);


//Users
Route::middleware('auth:sanctum')->get('/user/{id}', [UserController::class, 'getUserById']);










