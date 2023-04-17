<?php
// note: added constraint for unique product in card in some dbs (manually for now)
// TODO: add constraint for unique(product_id, user_id)
// fix seeder for shopping carts
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\User;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
