<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Image;

class ProductImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $attributes = [
        'isMain' => false,
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function image() {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
