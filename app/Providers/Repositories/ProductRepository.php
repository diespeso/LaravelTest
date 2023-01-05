<?php

namespace App\Providers\Repositories;

use App\Models\Product;
use App\Providers\Repositories\Interfaces\ProductRepositoryInterface;
use App\Providers\Repositories\GenericRepository;

use App\Providers\Repositories\GenericRepositoryTrait;

// TODO: por el momento no incluye las imágenes, adaptar para conseguir
// full imagenes y full reviews o quizas no, reflexionar sobre eso
class ProductRepository implements ProductRepositoryInterface {
    use GenericRepositoryTrait;
    public function model() {
        return Product::class;
    }
}