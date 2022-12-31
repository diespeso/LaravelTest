<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\Product;

use App\Providers\Repositories\Interfaces\GenericRepositoryInterface;
use App\Providers\Repositories\ProductRepository;

class DestroyController extends Controller
{

    protected GenericRepositoryInterface $products;

    public function __construct(ProductRepository $products) {
        $this->products = $products;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id): JsonResponse
    {
        $status = 200;
        if (!$this->products->destroy($id)) {
            $status = 409;
        }

        return response()->json([
            'data' => new \StdClass(),
        ], $status);
    }
}
