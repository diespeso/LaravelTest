<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Image;
use Database\Seeders\ProductImageSeeder;

class ProductImageApiTest extends TestCase
{

    use CreatesApplication, RefreshDatabase, DatabaseMigrations;

    public function setUp(): void {
        parent::setUp();
    }
    
    public function test_factory_works() {
        $this->seed(ProductImageSeeder::class);

        foreach (ProductImage::all() as $productImage) {
            $this->assertInstanceOf(ProductImage::class, $productImage);
        }
    }

    public function test_index_works() {
        $this->seed(ProductImageSeeder::class);
        $this->get('api/v1/products/1/images')
            ->assertStatus(200)
            ->assertjsonCount(2, 'data')
            ->assertJsonFragment([
                'url' => 'www.thisIsATestingImageUrl.jpg',
                'isMain' => false,
            ]);
    }
    
    public function test_show_works() {
        $this->seed(ProductImageSeeder::class);
        $this->get('api/v1/products/1/images/1')
            ->assertStatus(200)
            ->assertJsonFragment([
                'url' => 'www.thisIsATestingImageUrl.jpg',
                'isMain' => true,
            ]);
    }

    public function test_store_works() {
        $this->seed(ProductImageSeeder::class);
        $instance = [
            'url' => 'www.testingPost.jpg',
            'isMain' => true,
        ];
        $currentCount = Image::count();
        $this->postJson('api/v1/products/1/images', $instance)
            ->assertStatus(200) // TODO: better check count
            ->assertJsonFragment([
                'url' => 'www.testingPost.jpg',
                'isMain' => true,
            ]);
        $this->assertEquals(Image::count(), $currentCount + 1);
    }

    public function test_patch_works() {
        $this->seed(ProductImageSeeder::class);
        $updateBody = [
            'isMain' => true,
        ];

        $this->patchJson('api/v1/products/1/images/1', $updateBody)
            ->assertStatus(200)
            ->assertJsonFragment($updateBody);
        $this->assertTrue(
            ProductImage::where([['image_id', 1], ['product_id', 1]])->first()->isMain
        );
    }
}
