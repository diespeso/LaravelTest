<?php

namespace App\Providers\Repositories;

use App\Models\Product;
use App\Providers\Repositories\Interfaces\ProductRepositoryInterface;
use App\Providers\Repositories\GenericRepository;

class ProductRepository extends GenericRepository implements ProductRepositoryInterface{
    public function model() {
        return Product::class;
    }
}
/*
class ProductRepository implements ProductRepositoryInterface
{
    public function show(int $id): Product {
        //return Product::find($id);
        return GenericUtils::show(Product::class, $id);
    }

    public function index() {
        return GenericUtils::index(Product::class);
    }
}
*/