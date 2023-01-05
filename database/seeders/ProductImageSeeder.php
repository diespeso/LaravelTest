<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Image;
use App\Models\ProductImage;
/**
 * Seeder for productImage that runs both Image and Product. (standalone)
 */
class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entityCount = 2;

        $staticProduct = new Product([
            'name' => 'testProductOne',
            'description' => 'testDescriptionOne',
            'price' => 60.90,
        ]);
        $staticProduct->save();
        $staticProduct->refresh();

        $staticImage = new Image([
            'url' => 'www.thisIsATestingImageUrl.jpg',
        ]);
        $staticImage->save();
        $staticImage->refresh();

        $staticBridge = new ProductImage([
            'image_id' => $staticImage->id,
            'product_id' => $staticProduct->id,
            'isMain' => true,
        ]);
        $staticBridge->save();
        $staticBridge->refresh();

        $staticImageTwo = new Image([
            'url' => 'www.TestingUrlForTwo.jpg',
        ]);
        $staticImageTwo->save();
        $staticImageTwo->refresh();

        $staticBridgeTwo = new ProductImage([
            'image_id' => $staticImageTwo->id,
            'product_id' => $staticProduct->id,
        ]);
        $staticBridgeTwo->save();
        $staticBridgeTwo->refresh();
        
        $dynamicProducts= Product::factory()->count($entityCount)->create();
        $dynamicImages = Image::factory()->count($entityCount)->create();
        
        foreach ($dynamicProducts as $key => $value) {
            ProductImage::factory()->create([
                'image_id' => $dynamicImages[$key]->id,
                'product_id' => $value->id,
                'isMain' => true,
            ]);
        }
    }
}
