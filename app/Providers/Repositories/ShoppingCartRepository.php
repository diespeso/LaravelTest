<?php

namespace App\Providers\Repositories;

use App\Providers\Repositories\GenericRepositoryTrait;

use App\Models\ShoppingCart;
use App\Models\ProductReview;
use App\Providers\Repositories\ProductReviewRepository;

class ShoppingCartRepository {
    use GenericRepositoryTrait;

    protected ProductReviewRepository $productReviews;

    public function __construct(ProductReviewRepository $productReviews) {
        $this->productReviews = $productReviews;
    }

    public function model() {
        return ShoppingCart::class;
    }

    public function indexFull() {
        // todo: use scopes to get only the main image?
        return ShoppingCart::with('product.images')->get();
    }

    public function indexFromUser(int $userId) {
        $result = ShoppingCart::with('product.images')
            ->where('user_id', $userId)->get();
        return $result;
    }

    public function indexFromUserFull(int $userId) {
        $result = ShoppingCart::with('product.images')
            ->where('user_id', $userId)->get();
        $resultProc = $result->map(function ($shoppingCartProductInfo) {
            /*$scoreAverage = ProductReview::where('product_id', $shoppingCartProductInfo['product_id'])
                ->groupBy('product_id')->avg('score');// TODO: example
                */
            $scoreAverage = $this->productReviews->getScoreAverageFromProductId($shoppingCartProductInfo['product_id']);
            $shoppingCartProductInfo['scoreAverage'] = $scoreAverage;
            return $shoppingCartProductInfo;
        });
        return $resultProc;
    }
}