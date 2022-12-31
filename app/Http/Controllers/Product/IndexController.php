<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Providers\Repositories\GenericRepository;
use App\Providers\Repositories\Interfaces\ProductRepositoryInterface;
use App\Providers\Repositories\Interfaces\GenericRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Providers\Repositories\ProductRepository;

class IndexController extends Controller
{

    private ProductRepositoryInterface $products;

    public function __construct(ProductRepository $products) {
        $this->products = $products;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): JsonResponse
    {
        $found = $this->products->index();

        return response()->json([
            'data' => $found,
        ]);
    }
}
