<?php

use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Product;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ReviewImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/products', Product\Storecontroller::class);
Route::get('v1/products', Product\IndexController::class);
Route::get('v1/products/{id}', Product\ShowController::class);
Route::patch('v1/products/{id}', Product\UpdateController::class);
Route::delete('v1/products/{id}', Product\DestroyController::class);

/*
Route::get('v1/products/{productId}/product-reviews', ProductReview\IndexController::class);
Route::get('v1/products/{productId}/product-reviews/{id}', ProductReview\ShowController::class);
Route::patch('v1/products/{productId}/product-reviews/{id}', ProductReview\UpdateController::class);
Route::post('v1/products/{productId}/product-reviews', ProductReview\StoreController::class);
*/

Route::post('v1/products/{productId}/product-reviews', [ProductReviewController::class, 'store']);
Route::get('v1/products/{productId}/product-reviews', [ProductReviewController::class, 'index']);
Route::get('v1/products/{productId}/product-reviews/{id}', [ProductReviewController::class, 'show']);
Route::patch('v1/products/{productId}/product-reviews/{id}', [ProductReviewController::class, 'update']);
Route::delete('v1/products/{productId}/product-reviews/{id}', [ProductReviewController::class, 'destroy']);

// images with other type of URL
Route::get('v1/product-reviews/{productReviewId}/images', [ReviewImageController::class, 'index']);
Route::get('v1/product-reviews/{productReviewId}/images/{id}', [ReviewImageController::class, 'show']);
Route::patch('v1/product-reviews/{productReviewId}/images/{id}', [ReviewImageController::class, 'update']);
Route::post('v1/product-reviews/{productReviewId}/images', [ReviewImageController::class, 'store']);