<?php

// FIXME: NO FUNCIONA LA INYECCION DE REPOS

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Providers\Repositories\Interfaces\ProductRepositoryInterface;
use App\Providers\Repositories\Interfaces\GenericRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\Product;

use App\Providers\Repositories\ProductRepository;

class ShowController extends Controller
{

    private GenericRepositoryInterface $products;

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
        // $found = Product::find($id);
        try {
            $found = $this->products->show($id);
    
            $status = 200;
    
            if (!$found) {
                $status = 409;
            }
    
            return response()->json([
                'data' => $found,
            ], $status);
        } catch(\Exception $e) {
            echo $e;
        }
    }
}
