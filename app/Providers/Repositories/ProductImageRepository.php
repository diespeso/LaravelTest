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
        return $this->parentModel()::find($parentId)->images;
    }

    public function showFromParent(int $parentId, int $id) {
        return $this->indexFromParent($parentId)->find($id);
    }

    public function showFromparentFull(int $parentId, int $id) {
        return $this->indexFromParentFull($parentId)
            ->where('image_id', $id)->first();
    }

    public function storeFromParent($parentId, $createBody) {
        $model = $this->model();
        $newImage = $model::create($createBody);
        $newImage->refresh();

        $bridgeModel = $this->bridgeModel();
        $bridgeModel::create([
            'product_id' => $parentId,
            'image_id' => $newImage->id,
        ]);

        return $newImage;
    }

    public function patchFromParent($parentId, $id, $patchObject) {
        $found = $this->showFromparent($parentId, $id);
        if (!$found || !$found->update($patchObject)) {
            return null;
        }
        return $found->refresh();
    }

    public function indexFromParentFull(int $parentId) {
        $found = $this->parentModel()::find($parentId)
            ->with('product_image.image');
        return $found
            ->first()->product_image;
    }

}