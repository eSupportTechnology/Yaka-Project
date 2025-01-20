<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('user/register', [RegisteredUserController::class, 'create']) ->name('register');
    Route::get('user/register/get-otp', [RegisteredUserController::class, 'registerOtp']) ->name('register-otp');

    Route::post('user/register', [RegisteredUserController::class, 'store']);
    Route::post('user/register/confirm', [RegisteredUserController::class, 'storeRegister'])->name('storeRegister');


    Route::get('user/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('user/forgot', [AuthenticatedSessionController::class, 'forgot'])->name('forgot');
    Route::post('user/forgot', [AuthenticatedSessionController::class, 'sendOTP'])->name('sendOTP');

    Route::get('user/comfirm-otp', [AuthenticatedSessionController::class, 'comfirmOtpView'])->name('comfirmOtpView');
    Route::post('user/comfirm-otp', [AuthenticatedSessionController::class, 'comfirmOtp'])->name('comfirmOtp');
    Route::post('user/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy']) ->name('logout');
});
