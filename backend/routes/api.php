<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'regiter']);

// OAuth
Route::get('{provider}/oauth/redirect/', [OAuthController::class, 'OAuthRedirect']);
Route::get('{provider}/oauth/callback/', [OAuthController::class, 'OAuthCallback']);
Route::post('/oauth/exhange-token', [OAuthController::class, 'OAuthExchangeToken'])
    ->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/verify', [AuthController::class, 'verify']);
    Route::apiResource('users', UserController::class);
    Route::get('/getChatMessages/{receiver_id}', [ChatMessageController::class, 'index']);
    Route::post('/sendChatMessage', [ChatMessageController::class, 'store']);
    Route::post('/chat/typing', [ChatMessageController::class, 'typing']);
});
