<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductReview;
use App\Models\Image;
use App\Models\ProductImage;

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
            ->hasManyThrough(Image::class, ProductImage::class, 'product_id', 'id', 'id', 'image_id')
        ;
    }

    public function product_image() {
        return $this->hasMany(ProductImage::class);
    }
}
