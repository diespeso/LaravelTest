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
use App\Providers\Repositories\ProductImageRepository;

class ShowController extends Controller
{

    // private GenericRepositoryInterface $products;
    protected ProductRepository $products;
    protected ProductImageRepository $productImages;

    public function __construct(
        ProductRepository $products,
        ProductImageRepository $productImages,
        ) {
        $this->products = $products;
        $this->productImages = $productImages;
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

            if ($request->query('with_main_image')) {
                $image = $this->productImages->showProductMainImage($id);
                $found->image = $image;
                // return response()->json(['data' => 32]);
            }
    
            $status = 200;
    
            if (!$found) {
                $status = 409;
            }
    
            return response()->json([
                'error' => $found == null,
                'data' => $found,
            ], $status);
        } catch(\Exception $e) {
            echo $e;
        }
    }
}
