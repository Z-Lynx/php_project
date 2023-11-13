<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Email verification notice route
Route::get('/email/verify', function (Request $request) {
    return $request->user()->hasVerifiedEmail()
        ? response('Email already verified', 200)
        : response('Email not verified', 403);
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.notice');

// Email verification handler route
Route::get('/email/verify/{id}/{hash}', function (Request $request) {

    $user = \App\Models\User::find($request->route('id'));

    if ($user->hasVerifiedEmail()) {
        return response('Email already verified', 200);
    }

    if ($user->markEmailAsVerified()) {
        event(new \Illuminate\Auth\Events\Verified($user));
    }

    return response('Email verified', 200);
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

// Resend verification email route
Route::post('/email/resend', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return response('Email already verified', 200);
    }

    $request->user()->sendEmailVerificationNotification();

    return response('Verification email sent', 200);
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.resend');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forget-password', [AuthController::class, 'forget_password']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/info', [AuthController::class, 'info']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

