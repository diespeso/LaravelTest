<?php

namespace App\Providers\Repositories;

use App\Providers\Repositories\GenericRepositoryTrait;

use App\Models\ShoppingCart;

class ShoppingCartRepository {
    use GenericRepositoryTrait;

    public function model() {
        return ShoppingCart::class;
    }

    public function indexFull() {
        // todo: use scopes to get only the main image?
        return ShoppingCart::with('product.images')->get();
    }
}