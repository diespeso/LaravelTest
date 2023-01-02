<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ReviewImage;
use App\Models\ProductImage;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function review_image() {
        return $this->belongsTo(ReviewImage::class. 'review_id');
    }

    public function product_image() {
        return $this->belongsTo(ProductImage::class, 'product_id');
    }
}
