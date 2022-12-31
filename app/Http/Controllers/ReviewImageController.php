<?php

namespace App\Http\Controllers;

use App\Models\ReviewImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewImageRequest;
use App\Http\Requests\UpdateReviewImageRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\ProductReview;
use App\Providers\Repositories\ReviewImageRepository;

class ReviewImageController extends Controller
{

    protected ReviewImageRepository $reviewImages;

    public function __construct(ReviewImageRepository $reviewImages) {
        $this->reviewImages = $reviewImages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $productReviewId): JsonResponse
    {
        $images = $this->reviewImages->indexFromParent($productReviewId);

        return response()->json([
            'data' => $images,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReviewImage  $reviewImage
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewImage $reviewImage, $productReviewId, $id): JsonResponse
    {
        $image = $this->reviewImages->showFromParent($productReviewId, $id);

        return response()->json([
            'data' => $image,
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
     * @param  \App\Http\Requests\StoreReviewImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewImageRequest $request, $productReviewId): JsonResponse
    {
        $created = $this->reviewImages->storeFromParent($productReviewId, $request->all()); // TODO turn into transaction
        return response()->json([
            'data' => $created,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReviewImage  $reviewImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ReviewImage $reviewImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewImageRequest  $request
     * @param  \App\Models\ReviewImage  $reviewImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewImageRequest $request, int $parentId, int $id): JsonResponse
    {
        $updated = $this->reviewImages->patchFromParent($parentId, $id, $request->all());

        return response()->json([
            'data' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReviewImage  $reviewImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReviewImage $reviewImage)
    {
        //
    }
}
