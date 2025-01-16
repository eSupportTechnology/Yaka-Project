<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\indexController;
use App\Http\Controllers\web\userDashboardController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\detailsController;
use App\Http\Controllers\web\adsDisplayController;
use App\Http\Controllers\web\adsPosttController;


Route::get('/',[indexController::class,'index'])->name('/');
Route::get('lang/change', [indexController::class, 'index'])->name('changeLang');
Route::get('/about-us', [HomeController::class,'aboutUs'])->name('about-us');
Route::get('/contact-us',[HomeController::class,'contactUs'])->name('contact-us');
Route::get('/privacy-safety',[HomeController::class,'privacySafety'])->name('privacy-safety');
Route::post('/contact-submit', [HomeController::class, 'submit'])->name('contact.submit');
Route::get('/careers',[HomeController::class,'careers'])->name('careers');
Route::get('/tems-conditions',[HomeController::class,'temsConditions'])->name('tems-conditions');
Route::get('/faq',[HomeController::class,'faq'])->name('faq');

Route::get('/search', [SearchController::class,'index'])->name('search');

//adsDisplayController
Route::get('/ads/{category}', [adsDisplayController::class,'index'])->name('ads');
Route::get('/ads/details/{id}', [detailsController::class,'index'])->name('ads.details');
Route::get('/ads/bump-up/{id}', [bumpUpController::class,'index'])->name('ads.bump-up');
Route::get('/ads/{category}/{location}', [adsDisplayController::class,'index'])->name('ads.location');
Route::post('/ads/{category}/{location}', [adsDisplayController::class,'index'])->name('ads.location');

Route::get('/user/dashboard/ad-post',[userDashboardController::class,'mainCategories'])->name('user.dashboard.ad-post.main');



Route::get('/tips', [HomeController::class,'Tips'])->name('tips');
Route::get('/boosting-ads', [HomeController::class,'BoostingAds'])->name('boosting-ads');
Route::get('/ads-posting-allowances', [HomeController::class,'AdpostingAllowances'])->name('ads-posting-allowances');
Route::get('/ad-posting-criteria', [HomeController::class,'Adpostingcriteria'])->name('ad-posting-criteria');
Route::get('/banner-ads', [HomeController::class,'BannerAds'])->name('banner-ads');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
