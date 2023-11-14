<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
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
Route::get('/auth/{provider}', [ProviderSocialiteController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderSocialiteController::class, 'callback']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post(
    '/forget_password',
    [AuthController::class, 'forget_password']
)->middleware('guest')->name('password.email');

Route::post(
    '/reset_password',
    [AuthController::class, 'reset_password']
)->middleware('guest')->name('password.update');

Route::get('/images/{filename}', [AuthController::class, 'getImage'])->middleware('guest');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/info', [AuthController::class, 'info']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

