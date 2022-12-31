<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ReviewImage;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function review_image() {
        return $this->belongsTo(ReviewImage::class. 'review_id');
    }
}
