<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\frontend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Http\Controllers\adminPanel\usersManagementController;
use App\Http\Controllers\adminPanel\adminManagementController;
use App\Http\Controllers\adminPanel\adsTypesManagementController;
use App\Http\Controllers\adminPanel\dashboardController;
use App\Http\Controllers\adminPanel\categoriesManagementController;
use App\Http\Controllers\adminPanel\subCategoriesManagementController;
use App\Http\Controllers\adminPanel\brandsManagementController;
use App\Http\Controllers\adminPanel\packageManagementController;
use App\Http\Controllers\adminPanel\modlesManagementController;
use App\Http\Controllers\adminPanel\subPackageManagementController;
use App\Http\Controllers\adminPanel\adsManagementController;
use App\Http\Controllers\adminPanel\bannerManagementController;
use App\Http\Controllers\Auth\CustomAuthController;

use App\Http\Controllers\frontend\UserDashboardController;
use App\Http\Controllers\frontend\AdsController;

Route::get('/custom-login', function () {
    return view('newFrontend.login');
})->name('user.login');
Route::post('/custom-login', [CustomAuthController::class, 'login'])->name('custom.login');
Route::post('logout', [CustomAuthController::class, 'logout'])->name('logout');


Route::post('/register', [RegisteredUserController::class, 'register']);

Route::get('/',[HomeController::class,'home'])->name('/');

Route::get('/about-us', [HomeController::class,'aboutUs'])->name('about-us');
Route::get('/contact-us',[HomeController::class,'contactUs'])->name('contact-us');
Route::get('/privacy-safety',[HomeController::class,'privacySafety'])->name('privacy-safety');
Route::get('/terms-conditions',[HomeController::class,'termsConditions'])->name('terms-conditions');


Route::get('/browse_ads', [AdsController::class, 'browseAds'])->name('browse-ads');
Route::get('/browse_ads_details/{ad_id}', [AdsController::class, 'show_details'])->name('ads.details');


Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
    Route::get('/get-cities', [UserDashboardController::class, 'getCities'])->name('get.cities');
    Route::post('/user/profile/update', [UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/user/ad_posts', [UserDashboardController::class, 'ad_posts'])->name('user.ad_posts');
    Route::post('/user/ad_posts', [UserDashboardController::class, 'ad_posts'])->name('user.ad_posts');






    

});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Auth\AdminLoginController;

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


Route::middleware([App\Http\Middleware\AdminAuth::class])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    //adminManagementController
    Route::get('/dashboard/admins',[adminManagementController::class ,'index'])->name('dashboard.admins');
    Route::get('/dashboard/admins/create',[adminManagementController::class ,'create'])->name('dashboard.admins.create');
    Route::post('/dashboard/admins/create',[adminManagementController::class ,'store'])->name('dashboard.admins.store');
    Route::post('/dashboard/admins/give-access',[adminManagementController::class ,'giveAccess'])->name('dashboard.admins.give-access');
    Route::post('/dashboard/admins',[adminManagementController::class ,'search'])->name('dashboard.admins.search');
    Route::get('/dashboard/admins/view/{id}',[adminManagementController::class ,'view'])->name('dashboard.admins.view');
    Route::get('/dashboard/admins/update/{id}',[adminManagementController::class ,'update'])->name('dashboard.admins.update');
    Route::post('/dashboard/admins/update/{id}',[adminManagementController::class ,'updateUser'])->name('dashboard.admins.update-user');
    Route::get('/dashboard/admins/delete/{id}',[adminManagementController::class ,'delete'])->name('dashboard.admins.delete');
    Route::post('/dashboard/admins/delete/{id}',[adminManagementController::class ,'deleteUser'])->name('dashboard.admins.delete-user');

    //usersManagementController
    Route::get('/dashboard/users/{search?}',[usersManagementController::class ,'index'])->name('dashboard.users');
    Route::get('/dashboard/users/view/{id}',[adminManagementController::class ,'view'])->name('dashboard.users.view');
    Route::get('/dashboard/users/update/{id}',[adminManagementController::class ,'update'])->name('dashboard.users.update');
    Route::post('/dashboard/users/update/{id}',[adminManagementController::class ,'updateUser'])->name('dashboard.users.update-user');
    Route::get('/dashboard/users/delete/{id}',[adminManagementController::class ,'delete'])->name('dashboard.users.delete');
    Route::post('/dashboard/users/delete/{id}',[adminManagementController::class ,'deleteUser'])->name('dashboard.users.delete-user');

     //categoryManagementController
    //Main category
    Route::get('/dashboard/categories',[categoriesManagementController::class ,'index'])->name('dashboard.categories');
    Route::get('/dashboard/categories/create',[categoriesManagementController::class ,'create'])->name('dashboard.categories.create');
    Route::post('/dashboard/categories/create',[categoriesManagementController::class ,'store'])->name('dashboard.categories.store');
    Route::get('/dashboard/categories/view/{url}',[categoriesManagementController::class ,'view'])->name('dashboard.categories.view');
    Route::get('/dashboard/categories/update/{url}',[categoriesManagementController::class ,'update'])->name('dashboard.categories.update');
    Route::post('/dashboard/categories/update/{url}',[categoriesManagementController::class ,'updateCategory'])->name('dashboard.categories.update-category');
    Route::get('/dashboard/categories/delete/{url}',[categoriesManagementController::class ,'delete'])->name('dashboard.categories.delete');
    Route::post('/dashboard/categories/delete/{url}',[categoriesManagementController::class ,'deleteCategory'])->name('dashboard.categories.delete-category');

    //sub category
    Route::get('/dashboard/sub-categories/{url}',[subCategoriesManagementController::class ,'index'])->name('dashboard.sub-categories');
    Route::get('/dashboard/sub-categories/create/{url}',[subCategoriesManagementController::class ,'create'])->name('dashboard.sub-categories.create');
    Route::get('/dashboard/sub-categories/view/{url}',[subCategoriesManagementController::class ,'view'])->name('dashboard.sub-categories.view');
    Route::get('/dashboard/sub-categories/update/{url}',[subCategoriesManagementController::class ,'update'])->name('dashboard.sub-categories.update');
    Route::get('/dashboard/sub-categories/delete/{url}',[subCategoriesManagementController::class ,'delete'])->name('dashboard.sub-categories.delete');

     //usersManagementController
     Route::get('/dashboard/ads/{code?}',[adsManagementController::class ,'index'])->name('dashboard.ads');
     Route::get('/dashboard/ads/{status}/{id}',[adsManagementController::class ,'status'])->name('dashboard.ads.status');
 

    //brandManagementController
    Route::get('/dashboard/configuration/brands/{name?}',[brandsManagementController::class ,'index'])->name('dashboard.configuration.brands-and-models');
    Route::get('/dashboard/configuration/brands/create/brands',[brandsManagementController::class ,'create'])->name('dashboard.configuration.brands-and-models.create');
    Route::post('/dashboard/configuration/brands/create',[brandsManagementController::class ,'store'])->name('dashboard.configuration.brands-and-models.store');
    Route::get('/dashboard/configuration/brands/view/{url}',[brandsManagementController::class ,'view'])->name('dashboard.configuration.brands-and-models.view');
    Route::get('/dashboard/configuration/brands/update/{url}',[brandsManagementController::class ,'update'])->name('dashboard.configuration.brands-and-models.update');
    Route::post('/dashboard/configuration/brands/update/{url}',[brandsManagementController::class ,'updateBrand'])->name('dashboard.configuration.brands-and-models.update-brand');
    Route::get('/dashboard/configuration/brands/delete/{url}',[brandsManagementController::class ,'delete'])->name('dashboard.configuration.brands-and-models.delete');
    Route::post('/dashboard/configuration/brands/delete/{url}',[brandsManagementController::class ,'deleteBrand'])->name('dashboard.configuration.brands-and-models.delete-brand');

    //modelsManagementController
    Route::get('/dashboard/configuration/models/{url}{name?}',[modlesManagementController::class ,'index'])->name('dashboard.configuration.models');
    Route::get('/dashboard/configuration/models/create/{url}',[modlesManagementController::class ,'create'])->name('dashboard.configuration.models.create');
    Route::get('/dashboard/configuration/models/view/{url}',[modlesManagementController::class ,'view'])->name('dashboard.configuration.models.view');
    Route::get('/dashboard/configuration/models/update/{url}',[modlesManagementController::class ,'update'])->name('dashboard.configuration.models.update');

    //packageManagementController
    Route::get('/dashboard/package',[packageManagementController::class,'index'])->name('dashboard.packages');
    Route::get('/dashboard/package/create',[packageManagementController::class,'create'])->name('dashboard.package.create');
    Route::post('/dashboard/package/create',[packageManagementController::class,'store'])->name('dashboard.package.store');
    Route::get('/dashboard/package/view/{url}',[packageManagementController::class,'view'])->name('dashboard.package.view');
    Route::get('/dashboard/package/update/{url}',[packageManagementController::class,'update'])->name('dashboard.package.update');
    Route::post('/dashboard/package/update/{url}',[packageManagementController::class,'updatePackage'])->name('dashboard.package.update-package');
    Route::get('/dashboard/package/delete/{url}',[packageManagementController::class,'delete'])->name('dashboard.package.delete');
    Route::post('/dashboard/package/delete/{url}',[packageManagementController::class ,'deleteCategory'])->name('dashboard.package.delete-package');

    //subpackageController
    Route::get('/dashboard/subpack/update/{url}',[subPackageManagementController::class,'update'])->name('dashboard.sub-packages.update');
    Route::get('/dashboard/sub-packages/{url}',[subPackageManagementController::class ,'index'])->name('dashboard.sub-packages');
    Route::get('/dashboard/sub-packages/create/{url}',[subPackageManagementController::class ,'create'])->name('dashboard.sub-pacages.create');
    Route::post('/dashboard/sub-packages/store',[subPackageManagementController::class,'store'])->name('dashboard.subpackage.store');
    Route::get('/dashboard/sub-packages/view/{url}',[subPackageManagementController::class ,'view'])->name('dashboard.sub-package.view');
    Route::get('/dashboard/sub-packages/update/{url}',[subPackageManagementController::class ,'updatee'])->name('dashboard.sub-package.update');
    Route::post('/dashboard/sub-packages/update/{url}',[subPackageManagementController::class,'updateSubPackage'])->name('dashboard.package.update-subpackage');
    Route::get('/dashboard/sub-packages/delete/{url}',[subPackageManagementController::class ,'delete'])->name('dashboard.sub-package.delete');
    Route::post('/dashboard/sub-package/delete/{url}',[subPackageManagementController::class,'deleteSubPackage'])->name('dashboard.package.delete-subpackage');

     
    //Ads Types Management
    Route::get('/dashboard/adsTypeManagement/{name?}',[adsTypesManagementController::class,'index'])->name('dashboard.adsTypes');
    Route::get('/dashboard/adsTypeManagement/type/create',[adsTypesManagementController::class,'create'])->name('dashboard.adsTypes.create');
    Route::post('/dashboard/adsTypeManagement/create',[adsTypesManagementController::class,'store'])->name('dashboard.adsTypes.store');
    Route::get('/dashboard/adsTypeManagement/view/{url}',[adsTypesManagementController::class,'view'])->name('dashboard.adsTypes.view');
    Route::get('/dashboard/adsTypeManagement/update/{url}',[adsTypesManagementController::class,'update'])->name('dashboard.adsTypes.update');
    Route::post('/dashboard/adsTypeManagement/update/{url}',[adsTypesManagementController::class,'updateCategory'])->name('dashboard.adsTypes.updateCatergory');
    Route::get('/dashboard/adsTypeManagement/delete/{url}',[adsTypesManagementController::class,'delete'])->name('dashboard.adsTypes.delete');
    Route::post('/dashboard/adsTypeManagement/delete/{url}',[adsTypesManagementController::class,'deleteType'])->name('dashboard.adsTypes.deleteType');

    

    //bannerManagementController
    Route::get('/dashboard/banner',[bannerManagementController::class ,'index'])->name('dashboard.banner');
    Route::get('/dashboard/banner/view/{id}',[bannerManagementController::class ,'view'])->name('dashboard.banner.view');
    Route::get('/dashboard/banner/update/{id}',[bannerManagementController::class ,'update'])->name('dashboard.banner.update');
    Route::post('/dashboard/banner/update/{id}',[bannerManagementController::class ,'updatebanner'])->name('dashboard.banner.update-banner');
    Route::get('/dashboard/banner/create',[bannerManagementController::class ,'create'])->name('dashboard.banner.create');
    Route::post('/dashboard/banner/create',[bannerManagementController::class ,'createBanner'])->name('dashboard.banner.create-banner');
    Route::get('/dashboard/banner/delete/{id}',[bannerManagementController::class ,'delete'])->name('dashboard.banner.delete');
    Route::post('/dashboard/banner/delete/{id}',[bannerManagementController::class ,'deletebanner'])->name('dashboard.banner.delete-banner');

  



});


require __DIR__.'/auth.php';
