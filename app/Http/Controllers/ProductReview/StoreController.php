<?php

namespace App\Http\Controllers\ProductReview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductReview;
use App\Models\Product;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $productId)
    {
        try {
            $createBody = $request->all();
            $createObj = new ProductReview($createBody);
    
            $base = Product::find($productId);
    
            if (!$base->product_reviews()->save($createObj)) {
                return response()->json([
                    'data' => null,
                ], 500);
            }
    
            return response()->json([
                'data' => $createObj->refresh(),
            ]);
        } catch(\Exception $e) {
            echo $e;
        }

    }
}
