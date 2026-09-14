<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/verify', [AuthController::class, 'verify']);
    Route::apiResource('users', UserController::class);
    Route::get('/getChatMessages/{receiver_id}', [ChatMessageController::class, 'index']);
    Route::post('/sendChatMessage', [ChatMessageController::class, 'store']);
});
