<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ImageProductsController;
use App\Http\Controllers\imgCC;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderSocialiteController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BillsController;

use Illuminate\Support\Facades\Route;

// public client
Route::get('/images/{filename}', [AuthController::class, 'getImage'])->middleware('guest');
// Route get products
Route::get('/products', [ProductController::class, 'index'])->middleware('guest');

// AUTH
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

// auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// forget password
Route::post(
    '/forgot-password',
    [AuthController::class, 'forgot_password']
)->middleware('guest')->name('password.email');
Route::post(
    '/reset-password',
    [AuthController::class, 'reset_password']
)->middleware('guest')->name('password.update');

// middleware auth:sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/info', [AuthController::class, 'info']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/update-info', [UsersController::class, 'updateInfo']);
    Route::post('/add-to-cart', [CartsController::class, 'addToCart']);
    Route::post('/remove-from-cart', [CartsController::class, 'removeFromCart']);

    // payment
    Route::get('/vnpay-payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');
    Route::get('/vnpay-payment/callback', [PaymentController::class, 'vnpay_payment_callback'])->name('vnpay_payment_callback');
});

// is Admin
Route::group(['middleware' => ['auth:sanctum', 'isAdmin']], function () {

    Route::get('/notifications', [NotificationController::class, 'getNotifications']);
    Route::post('/notifications', [NotificationController::class, 'readNotification']);
    Route::post('/send-notifications', [NotificationController::class, 'sendNotifications']);

    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/image-products', ImageProductsController::class);
    Route::resource('/carts', CartsController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/bills', BillsController::class);
});