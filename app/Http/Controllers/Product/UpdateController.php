<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $patchBody = $request->all();
        $patchObject = Product::find($id);
        if (!$patchObject->update($patchBody)) {
            return response()->json([
                'data' => null,
            ], 500);
        }

        return response()->json([
            'data' => $patchObject,
        ]);
    }
}
