<?php

namespace App\Http\Controllers\ProductReview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductReview;
use App\Models\Product;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $productId)
    {
        $found = Product::with('product_reviews')->find($productId);
        $status = 200;
        if (!$found) {
            $status = 409;
        }

        return response()->json([
            'data' => $found,
        ], $status);
    }
}
