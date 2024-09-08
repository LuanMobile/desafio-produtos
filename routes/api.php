<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::post('/product/create', 'create');
        Route::put('/product/update/{id}', 'update');
        Route::get('/product/list', 'listProducts');
        Route::get('/product/{id}', 'getProduct');
        Route::delete('/product/delete/{id}', 'delete');
    });
});