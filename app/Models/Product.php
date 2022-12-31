<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductReview;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $attributes = [
        'description' => '',
        'imageUrl' => null,
    ];

    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
