<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Image;
use App\Models\ProductImage;

/**
 * Seeder to run when you have products and want to generate fake images for them
 * Generates a main image and one extra gallery image for every product
 * present in the database
 */
class ProductImageGeneratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: improve this bit. https://laravel.com/docs/9.x/eloquent-factories#has-many-relationships
        $productIds = Product::all()->map(function ($productInstance) {
            return $productInstance->id;
        });

        foreach ($productIds as $productId) {
            Image::factory()->count(2)->create()
                ->each(function ($imageInstance, $index) use ($productId) {
                    $bind = new ProductImage([
                        'product_id' => $productId,
                        'image_id' => $imageInstance->id,
                        'isMain' => $index === 0 ? true : false,
                    ]);
                    $bind->save();
                });
            /* error_log($instances);
            $bind = new ProductImage([
                'product_id' => $productId
            ])*/
        }
        error_log($productIds);
    }

}
