<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class Storecontroller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $creationBody = $request->all();
        $created = new Product($creationBody);
        
        if (!$created->save()) {
            return response()->json([
                'data' => null,
            ], 500);
        }

        return response()->json([
            'data' => $created->refresh(),
        ]);
    }
}
