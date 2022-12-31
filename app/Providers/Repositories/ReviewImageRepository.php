<?php
namespace App\Providers\Repositories;

use App\Models\ProductReview;
use App\Models\ReviewImage;
use App\Models\Image;

class ReviewImageRepository {

    public function parentModel() {
        return ProductReview::class;
    }

    public function bridgeModel() {
        return ReviewImage::class;
    }

    public function model() {
        return Image::class;
    }

    public function indexFromParent($parentId) {
        return $this->parentModel()::find($parentId)->images;
    }

    public function showFromParent($parentId, $id) {
        /* return $this->bridgeModel()::with('image')->where('product_review_id', $parentId)
            ->whereHas('image', function ($query) use ($id) {
                return $query->where('image_id', $id);
            })->find($id)?->image; // nullish
        */
        return $this->indexFromParent($parentId)->find($id);
    }

    public function storeFromParent($parentId,  $createBody) {
        $model = $this->model();
        $newImage = $model::create($createBody);
        $newImage->refresh();

        $bridgeModel = $this->bridgeModel();
        $newBridge = $bridgeModel::create([
            'product_review_id' => $parentId,
            'image_id' => $newImage->id,
        ]);
        return $newImage;
    }

    public function patchFromParent($parentId, $id, $patchObject) {
        $found = $this->showFromParent($parentId, $id);
        if(!$found || !$found->update($patchObject)) {
            return null;
        }
        return $found->refresh();
    }
}