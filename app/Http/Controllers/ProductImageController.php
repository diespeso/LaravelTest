<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\UpdateProductImageRequest;

use App\Providers\Repositories\ProductImageRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductImageController extends Controller
{
    protected ProductImageRepository $productImages;
    protected bool $isFull;

    public function __construct(ProductImageRepository $productImages) {
        $this->productImages = $productImages;
        $this->isFull = filter_var(request()->query('full'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $productId): JsonResponse
    {
        $result = null;
        if ($this->isFull) {
            $result = $this->productImages->indexFromParentFull($productId);
            // error_log($result->load('product_image'));
        } else {
            $result = $this->productImages->indexFromParent($productId);
        }
        return response()->json([
            'data' => $result,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductImageRequest $request, int $productId): JsonResponse
    {
        $result = $this->productImages->storeFromParent($productId, $request->all());

        return response()->json([
            'data' => $result,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImage $productImage, int $productId, int $id): JsonResponse
    {
        $result = null;
        if ($this->isFull) {
            $result = $this->productImages->showFromParentFull($productId, $id);
        } else {
            $result = $this->productImages->showFromParent($productId, $id);
        }
        

        return response()->json([
            'data' => $result,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductImageRequest  $request
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductImageRequest $request, int $productId, int $id): JsonResponse
    {
        $updated = $this->productImages->patchFromParent($productId, $id, $request->all());
        // WONT UPDATE bridge table, maybe add a query param for that?
        return response()->json([
            'data' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductImage $productImage)
    {
        //
    }
}
