<?php

namespace App\Http\Controllers\ProductReview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductReview;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $createBody = $request->all();

        $created = new ProductReview($createBody);

        if (!$created->save()) {
            return response()->json([
                'data' => null,
            ]);
        }

        return response()->json([
            'data' => $created->refresh(),
        ]);
    }
}
