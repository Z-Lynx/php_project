<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\imgCC;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderSocialiteController;
use Illuminate\Support\Facades\Route;

// EMAIL Verification
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth:sanctum', 'signed'])
    ->name('verification.verify');

Route::post('/email/resend', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth:sanctum', 'throttle:6,1'])
    ->name('verification.resend');

// socialite
Route::get('/auth/{provider}', [ProviderSocialiteController::class, 'redirect'])->middleware('guest');
Route::get('/auth/{provider}/callback', [ProviderSocialiteController::class, 'callback']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// forget password
Route::post(
    '/forgot_password',
    [AuthController::class, 'forgot_password']
)->middleware('guest')->name('password.email');

Route::post(
    '/reset_password',
    [AuthController::class, 'reset_password']
)->middleware('guest')->name('password.update');

// public client
Route::get('/images/{filename}', [AuthController::class, 'getImage'])->middleware('guest');

// Route get products
Route::get('/products', [ProductController::class, 'index']);

// middleware auth:sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/info', [AuthController::class, 'info']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('/products', ProductController::class);
});

// payment
Route::get('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');
Route::get('/vnpay_payment/callback', [PaymentController::class, 'vnpay_payment_callback'])->name('vnpay_payment_callback');