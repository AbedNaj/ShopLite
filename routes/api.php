<?php


use App\Http\Controllers\Api\V1\Auth\AdminAuthController;
use App\Http\Controllers\Api\V1\Auth\CustomerAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\V1\Admin\SubCategoryController as AdminSubCategoryController;
use App\Http\Controllers\api\v1\admin\ProductController as adminProductController;
use App\Http\Controllers\api\v1\admin\ProductImagesController as adminProductImages;

Route::prefix('v1')->group(function () {

    // Admin Routes
    Route::prefix('admin')->group(function () {


        Route::post('/login', [AdminAuthController::class, 'login']);



        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AdminAuthController::class, 'logout']);
            Route::get('/me', [AdminAuthController::class, 'me']);



            Route::prefix('categories/actions')->group(function () {
                // Fetch category ID and name for dropdown selects
                Route::get('/for-select', [AdminCategoryController::class, 'forSelect']);
            });

            Route::apiResource('/categories', AdminCategoryController::class)->whereUlid('category');



            Route::prefix('subCategories/actions')->group(function () {
                // Fetch Subcategory ID and name for dropdown selects
                Route::get('/for-select', [AdminSubCategoryController::class, 'forSelect']);
            });

            Route::apiResource('/subCategories', AdminSubCategoryController::class);

            Route::apiResource('/products', adminProductController::class);

            Route::apiResource('/productImages', adminProductImages::class);
        });
    });

    // Customer Routes
    Route::prefix('customer')->group(function () {
        Route::post('/login', [CustomerAuthController::class, 'login']);
        Route::post('/register', [CustomerAuthController::class, 'register']);
        Route::middleware('auth:sanctum')->post('/logout', [CustomerAuthController::class, 'logout']);
    });
});
