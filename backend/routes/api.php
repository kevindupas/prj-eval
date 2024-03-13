<?php

use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('categories', [ApiCategoryController::class, 'index']);
    Route::get('categories/{id}', [ApiCategoryController::class, 'show']);

    Route::get('products', [ApiProductController::class, 'index']);
    Route::get('products/{id}', [ApiProductController::class, 'show']);

    Route::get('category/{id}/products', [ApiProductController::class, 'getProductByCategory']);

});
