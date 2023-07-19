<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Providers\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Providers\Repositories\Interfaces\GenericRepositoryInterface;
use App\Providers\Repositories\ProductRepository;

use App\Models\ProductCategory;

class Storecontroller extends Controller
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
    public function __invoke(Request $request): JsonResponse
    {
        print_r($request->all());

        $creationBody = $request->all();
        $created = $this->products->store($creationBody);

        if ($request->has("categories")) {
            foreach($creationBody["categories"] as $categoryId) {
                ProductCategory::create([
                    "product_id" => $created["id"],
                    "category_id" => $categoryId,
                ]);
            }
        }

        return response()->json([
            'data' => $created,
        ], 201);
    }
}
