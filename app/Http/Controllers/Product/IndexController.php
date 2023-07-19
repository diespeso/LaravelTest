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
use App\Providers\Repositories\ProductImageRepository;

class IndexController extends Controller
{

    private ProductRepositoryInterface $products;
    private ProductImageRepository $productImages;

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
    public function __invoke(Request $request): JsonResponse
    {
        $found = null;
        if ($request->query('with_main_image')) {
            error_log('here i test');
            error_log($found);
            $found = $this->productImages->indexProductMainImage();
        } else {
            $found = $this->products->index();
        }
        
        return response()->json([
            'data' => $found,
        ]);
    }
}
