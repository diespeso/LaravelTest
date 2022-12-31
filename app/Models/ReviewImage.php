<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductReview;
use App\Models\Image;

class ReviewImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function review() {
        return $this->belongsTo(ProductReview::class, 'product_review_id');
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }
}
