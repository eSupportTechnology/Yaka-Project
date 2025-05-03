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
use App\Http\Controllers\apiMobile\UserPhoneNumberController;

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



Route::middleware(['auth:sanctum'])->group(function () {

    //Users
    Route::get('/user/{id}', [UserController::class, 'getUserById']);
    Route::put('/user-edit/{id}', [UserController::class, 'update']); //edit user account details

    //ads
    Route::delete('/delete-ads/{id}',[AdsController::class,'deleteById']);
    Route::post('/post-ad', [AdsController::class, 'postAd']); //post ads

    //phone
    Route::prefix('user-phone-numbers')->group(function () {
        Route::get('/{userId}', [UserPhoneNumberController::class, 'index']); // Get all phone numbers for a user
        Route::post('/', [UserPhoneNumberController::class, 'store']);        // Add a new phone number
        Route::put('/{id}', [UserPhoneNumberController::class, 'update']);    // Update a phone number
        Route::delete('/{id}', [UserPhoneNumberController::class, 'destroy']); // Delete a phone number
    });


});








