<?php

namespace App\Http\Controllers\ProductReview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductReview;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $productId, $id) //cambiar el que no se usa por wildcard?
    {
        try {
            $patchBody = $request->all();
            $patchObject = ProductReview::find($id);
            error_log($patchObject);
            error_log($id);
            $status = 200;
            if (!$patchObject || $patchObject->update($patchBody)) {
                $status = 409;
            }
    
            return response()->json([
                'data' => $patchObject->refresh(),
            ],  $status);
        } catch (\Exception $e) {
            echo $e;
        }

    }
}
