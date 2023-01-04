<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staticProduct = new Product([
            'name' => 'testProductOne',
            'description' => 'testDescriptionOne',
            'price' => 60.90,
        ]);
        Product::factory()->create($staticProduct->toArray());
        Product::factory()->count(9)->create();
    }
}
