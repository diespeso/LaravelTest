<?php

namespace App\Http\Controllers\ProductReview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductReview;

class ShowController extends Controller
{
    private $id;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $productId, $id)
    {
        $this->id = $id;
        // works
        $found = ProductReview::where([['product_id', $productId], ['id', $id]])->first();

        //subqueries
        /* $found = Product::with(['product_reviews' => function ($query) {
            error_log($id);
            $query->where('id', $this->id);
        }])->find($productId); */
        $status = 200;
        if (!$found) {
            $status = 409;
        }

        return response()->json([
            'data' => $found,
        ], $status);
    }
}
