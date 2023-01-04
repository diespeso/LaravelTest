<?php
namespace App\Providers\Repositories;

use App\Models\Product;
use App\Models\Image;
use App\Models\ProductImage;

// TODO: haceruna interfaz para este caso y el el de reviewimagerepository
// TODO: considerar usar repositorios en lugar de las clases concretas?
class ProductImageRepository {
    public function parentModel() {
        return Product::class;
    }

    public function bridgeModel() {
        return ProductImage::class;
    }

    public function model() {
        return Image::class;
    }

    public function indexFromParent(int $parentId) {
        $images = $this->bridgeModel()::where('product_id', $parentId)->get(['image_id', 'product_id', 'isMain']);
        $imageIds = $images->map(function ($imageInstance) { return $imageInstance->image_id; });
        return $this->model()::whereIn('id', $imageIds)->get()
            ->map((function ($imageInstance, $key) use ($images) {
                $imageInstance->isMain = $images[$key]->isMain;
                $imageInstance->product_id = $images[$key]->product_id;
                return $imageInstance;
            }));
    }

    public function showFromParent(int $parentId, int $id) {
        return $this->indexFromParent($parentId)->find($id);
    }

    public function showProductMainImage(int $parentId): Image | null {
        return $this->bridgeModel()
            ::with('image')->where([['product_id', $parentId], ['isMain', true]])
            ->first()->image ?? null;
    }

    public function indexProductMainImage() {
        $outerThis = $this;
        return $this->parentModel()::all()->map((function ($test) use ($outerThis) {
            $test->image = $outerThis->showProductMainImage($test->id);
            return $test;
        }));
    }

    public function showFromparentFull(int $parentId, int $id) {
        return $this->indexFromParentFull($parentId)
            ->where('image_id', $id)->first();
    }

    public function storeFromParent($parentId, $createBody) {
        $model = $this->model();
        $newImage = $model::create($createBody->all());
        $newImage->refresh();

        $bridgeModel = $this->bridgeModel();
        $bridgeInstance = $bridgeModel::create([
            'product_id' => $parentId,
            'image_id' => $newImage->id,
            'isMain' => $createBody->get('isMain') ?? false,
        ]);

        $newImage->product_id = $bridgeInstance->product_id;
        $newImage->isMain = $bridgeInstance->isMain;

        return $newImage;
    }

    public function patchFromParent($parentId, $id, $patchRequest) {
        $patchObject = $patchRequest->all();
        $isMain = $patchRequest->isMain;
        $found = $this->showFromparent($parentId, $id);
        // extra fields, delete them
        $storeIsMain = $found->isMain;
        unset($found->isMain);
        $storeProductId = $found->product_id;
        unset($found->product_id);
        if (!$found || !$found->update($patchObject)) { // found checks and update
            return null;
        }
        $found->refresh();
        // bridge update as well in this case
        $foundBridge = $this->bridgeModel()::where([['product_id', $parentId], ['image_id', $id]])
            ->first();
        $foundBridge->update(['isMain' => $isMain ?? $storeIsMain]); // sets isMain bridge field
        $found->isMain = $foundBridge->isMain;
        $found->product_id = $storeProductId;
        return $found;
    }

    public function indexFromParentFull(int $parentId) {
        $found = $this->parentModel()::find($parentId)
            ->with('product_image.image');
        return $found
            ->first()->product_image;
    }

}