<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Providers\Repositories\ProductReviewRepository;

class ProductReviewController extends Controller
{
    protected ProductReviewRepository $products;

    public function __construct(ProductReviewRepository $products) {
        $this->products = $products;
    }

    public function index(Request $request, $productId) {
        $index = $this->products->indexFromParent($productId);
        $info = new \stdClass();
        if($request->query('average')) {
            $avg = $this->products->model()::avg('score');
            $info->average = $avg;
        }
        if ($request->query('count')) {
            $count = $this->products->model()::count();
            $info->count = $count;
        }
        return response()->json([
            'data' => $index,
            'info' => $info,
        ]);
    }

    public function show(Request $request, $productId, $id) {
        $found = $this->products->showFromParent($productId, $id);
        error_log($found);
        return response()->json([
            'data' => $found,
        ]);
    }

    public function update(Request $request, $productId, $id) {
        $patchObject = $request->all();
        $patched = $this->products->patchFromParent($productId, $id, $patchObject);
        error_log($patched);
        return response()->json([
            'data' => $patched,
        ]);
    }

    public function destroy(Request $request, $productId, $id) {
        $deleted = $this->products->destroyFromParent($productId, $id);
        $status = $deleted ? 200 : 500;

        return response()->json([
            'data' => null,
        ], $status);
    }

    public function store(Request $request, $productId) {
        $created = $this->products->storeFromParent($productId, $request->all());

        return response()->json([
            'data' => $created,
        ]);
    }
}
