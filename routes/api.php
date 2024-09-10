<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/product/list', [ProductController::class, 'listProducts']);
Route::get('/product/{id}', [ProductController::class, 'getProduct']);

Route::middleware('auth:api')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::post('/product/create', 'create');
        Route::put('/product/update/{id}', 'update');
        Route::delete('/product/delete/{id}', 'delete');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::post('/auth/logout', 'logout');
        Route::post('/auth/refresh', 'refresh');
    });
});