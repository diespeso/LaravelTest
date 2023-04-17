<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductReview;
use App\Providers\Repositories\ProductRepository;

class SearchController extends Controller
{
    protected ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    //
    public function show(Request $request) {
        $likeName = $request->query('likeName');
        $found = $this->products->model()
            ::with('images')
            ->with('categories')
            ->whereHas('images', function ($q) {
                $q->where('isMain', 1);
            })
            ->where('name', 'LIKE', '%'.$likeName.'%')->get();
        $foundProcessed = $found->map(function ($f) {
            $newFound = [
                ...$f->toArray(),
                'image' => $f->images[0],
            ];
            unset($newFound['images']);
            return $newFound;
        });
        return response()->json([
            'data' => $foundProcessed,
        ]);
    }
}
