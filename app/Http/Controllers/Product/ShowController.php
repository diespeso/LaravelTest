<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $found = Product::find($id);

        $status = 200;

        if (!$found) {
            $status = 409;
        }

        return response()->json([
            'data' => $found,
        ], $status);
    }
}
