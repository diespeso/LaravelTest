<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Product;
use App\Http\Controllers\ProductReview;

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

Route::get('v1/products/{productId}/product-reviews', ProductReview\IndexController::class);
Route::get('v1/products/{productId}/product-reviews/{id}', ProductReview\ShowController::class);
Route::post('v1/product-reviews', ProductReview\StoreController::class);