<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PostController;

Route::prefix('auth')->group(function () {
    Route::post('/register', [ApiAuthController::class, 'register']);
    Route::post('/login', [ApiAuthController::class, 'login']);

    Route::middleware('ApiAuth')->group(function () {
        Route::post('/logout', [ApiAuthController::class, 'logout']);
    });
});





Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'all']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::post('/', [PostController::class, 'store']);
    Route::put('/{id}', [PostController::class, 'update']);
    Route::delete('/{id}', [PostController::class, 'delete']);
});



Route::post('/payment/create-checkout-link', [PaymentController::class, 'createCheckoutLink']);
Route::post('/stripe/webhook', [PaymentController::class, 'handleWebhook']);


