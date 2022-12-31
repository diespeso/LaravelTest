<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ReviewImage;
use App\Models\Image;

class ProductReview extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Models\Product::class, 'product_id');
    }

    /*public function review_images()
    {
        return $this->hasMany(ReviewImage::class);
    }*/

    public function images() {
        // return $this->hasOne(Image::class, 'id');
        return $this->hasManyThrough(Image::class, ReviewImage::class, 'product_review_id', 'id', 'id', 'image_id');
    }
}
