<?php

namespace App\Providers\Repositories;

use App\Providers\Repositories\GenericRepository;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ReviewImage;
use App\Models\Image;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Providers\Repositories\ReviewImageRepository;

class ProductReviewRepository extends GenericRepository {

    protected ReviewImageRepository $reviewImages;

    public function __construct(ReviewImageRepository $reviewImages) {
        $this->reviewImages = $reviewImages;
    }

    public function model() {
        return ProductReview::class;
    }

    public function parentModel() {
        return Product::class;
    }

    public function index() {
        return $this->model()::all();
    }

    public function indexFromParent($parentId) {
        return $this->parentModel()::with('product_reviews.images')
            ->find($parentId)
            ->product_reviews ?? null; //TODO exception throw

    }

    public function showFromParent($parentId, $id) {
        return $this->model()::with('images')->where([['product_id', $parentId], ['id', $id]])
            ->first() ?? null;
    }

    public function patchFromParent($parentId, $id, $patchObject) {
        $found = $this->showFromParent($parentId, $id);
        if (!$found || !$found->update($patchObject)) {
            return null;
        }
        return $found->refresh();
    }

    public function destroyFromParent($parentId, $id) {
        $found = $this->showFromParent($parentId, $id);
        if (!$found) {
            echo "failed to delete an entry";
            return false;
        }
        $found->delete();
        return true;
    }

    public function storeFromParent($parentId, $createBody) {
        $model = $this->model();
        $createObject = new $model($createBody);
        $foundParent = $this->parentModel()::find($parentId);
        // $rule = !$foundParent || !$foundParent->product_reviews()->save($createObject); // one way
        $rule = !$foundParent || !$foundParent->product_reviews()->save($createObject);

        if ($rule) {
            return null;
        }
        return $createObject->refresh();
    }
}