<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class DestroyController extends Controller
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
        $status = 204;

        if ($found) {
            $found->delete();
        } else {
            $status = 409;
        }

        return response()->json([
            'data' => new \StdClass(),
        ], $status);
    }
}
