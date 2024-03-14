<?php

use App\Http\Controllers\Api\ApiBrandController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {

    Route::get('categories', [ApiCategoryController::class, 'index']);
    Route::get('category/{id}', [ApiCategoryController::class, 'show']);

    Route::get('products', [ApiProductController::class, 'index']);
    Route::get('products/{id}', [ApiProductController::class, 'show']);
    Route::get('category/{id}/products', [ApiProductController::class, 'getProductByCategory']);

    Route::get('brands', [ApiBrandController::class, 'index']);
    Route::get('brand/{id}', [ApiBrandController::class, 'show']);
    Route::get('brand/{brandId}/products', [ApiBrandController::class, 'getProductsByBrand']);

    Route::get('services', [ApiServiceController::class, 'index']);
    Route::get('service/{id}', [ApiServiceController::class, 'show']);
});
