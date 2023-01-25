<?php

namespace Database\Seeders;

use App\Models\ShoppingCart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\ProductSeeder;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staticShoppingCartProduct = new ShoppingCart([
            'amount' => 1,
            'product_id' => 1,
            'user_id' => 1,
        ]);
        $staticShoppingCartProduct->save();

        ShoppingCart::factory()->count(10)->create();
    }
}
