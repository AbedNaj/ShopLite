<?php

use App\Http\Controllers\Api\V1\Auth\AdminAuthController;
use App\Http\Controllers\Api\V1\Auth\CustomerAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\V1\Admin\SubCategoryController as AdminSubCategoryController;

Route::prefix('v1')->group(function () {

    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::post('/login', [AdminAuthController::class, 'login']);



        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AdminAuthController::class, 'logout']);

            Route::apiResource('/categories', AdminCategoryController::class);

            Route::apiResource('/subCategories', AdminSubCategoryController::class);
        });
    });

    // Customer Routes
    Route::prefix('customer')->group(function () {
        Route::post('/login', [CustomerAuthController::class, 'login']);
        Route::post('/register', [CustomerAuthController::class, 'register']);
        Route::middleware('auth:sanctum')->post('/logout', [CustomerAuthController::class, 'logout']);
    });
});
