<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductReview;
use App\Models\Image;
use App\Models\ProductImage;

use App\Models\Category;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $attributes = [
        'description' => '',
    ];

    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function images() {
        return $this
            ->hasManyThrough(Image::class, ProductImage::class, 'product_id', 'id', 'id', 'image_id');
    }

    public function categories() {
        return $this
            ->hasManyThrough(Category::class, ProductCategory::class, 'product_id', 'id', 'id', 'category_id');
    }

    public function product_image() {
        return $this->hasMany(ProductImage::class);
    }
}
