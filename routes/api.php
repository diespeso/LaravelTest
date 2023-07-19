<?php

use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\User\LoginControler;
use App\Models\ProductReview;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Product;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ReviewImageController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\User\SignUpController;
use App\Http\Controllers\SearchController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductCategoryController;

// testing 
use App\Models\User;
use App\Models\Rol;
use App\Models\Permission;

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

Route::middleware('jwt.verify')->group(function() {
    Route::get('v1/shopping-carts', [ShoppingCartController::class, 'index']);
    Route::post('v1/shopping-carts', [ShoppingCartController::class, 'store']);
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

Route::get('v1/products/{productId}/images', [ProductImageController::class, 'index']);
Route::get('v1/products/{productId}/images/{id}', [ProductImageController::class, 'show']);
Route::patch('v1/products/{productId}/images/{id}', [ProductImageController::class, 'update']);
Route::post('v1/products/{productId}/images', [ProductImageController::class, 'store']);

Route::get('v1/products/{productId}/categories', [ProductCategoryController::class, 'index']);

// Route::post('v1/shopping-carts', [ShoppingCartController::class, 'store']);
Route::get('v1/shopping-carts/{id}', [ShoppingCartController::class, 'show']);
Route::patch('v1/shopping-carts/{id}', [ShoppingCartController::class, 'update']);

Route::delete('v1/shopping-carts/{id}', [ShoppingCartController::class, 'destroy']);

Route::post('v1/login', LoginControler::class);
Route::post('v1/signup', SignUpController::class);

Route::get('v1/search', [SearchController::class, 'show']);

Route::get('v1/categories', [CategoryController::class, 'index']);
Route::get('v1/categories/{id}', [CategoryController::class, 'show']);

Route::get('v1/test', function (Request $request) {

    //$found = User::with("roles")->get();
    $found = Rol::with("permissions")->get();
    $found2 = Permission::all();
    $found3 = User::with("roles")->get();

    return response()->json([
        "data" => $found,
        "data2" => $found2,
        "data3" => $found3[0]->roles,
    ]);
});