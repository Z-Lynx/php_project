<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\ClientController;
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

// Payment
Route::get('/vnpay-payment/{id}', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');
Route::get('/vnpay-payment/{id}/callback', [PaymentController::class, 'vnpay_payment_callback'])->name('vnpay_payment_callback');

// get Products
Route::get('/get-products', [ClientController::class, 'getProducts'])->middleware('guest');
Route::get('/get-product/{id}', [ClientController::class, 'getProduct'])->middleware('guest');

// middleware auth:sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Auth
    Route::get('/info', [AuthController::class, 'info']);
    Route::get('/notifications', [NotificationController::class, 'getNotifications']);
    Route::post('/notifications', [NotificationController::class, 'readNotification']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update-profile', [ClientController::class, 'updateInfo']);
    Route::get('/my-order', [ClientController::class, 'myOrder']);

    // Set token fcm
    Route::post('/set-token', [NotificationController::class, 'setToken']);

    // Get carts
    Route::get('/get-carts', [ClientController::class, 'getCarts']);
    Route::post('/add-to-cart', [ClientController::class, 'addToCart']);
    Route::put('/update-cart/{id}', [ClientController::class, 'updateCart']);
    Route::delete('/remove-cart/{id}', [ClientController::class, 'removeFromCart']);

});

// is Admin
Route::group(['middleware' => ['auth:sanctum', 'isAdmin']], function () {
    Route::post('/send-notifications', [NotificationController::class, 'sendNotifications']);

    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/image-products', ImageProductsController::class);
    Route::resource('/carts', CartsController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/bills', BillsController::class);
});