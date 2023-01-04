<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;

use Tests\CreatesApplication;
use Tests\TestCase;

use Database\Seeders\ProductSeeder;
use Database\Seeders\ProductImageSeeder;

use App\Models\Product;

class ProductApi extends TestCase
{
    use CreatesApplication, DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();
        // Artisan::call('db:seed');
    }

    public function test_factory_works() {
        $instance = Product::factory()->create();
        $this->assertInstanceOf(Product::class, $instance, 'testing');
    }

    public function test_post_one_from_json_works() {
        $instance = Product::factory()->create();
        $response = $this->postJson('/api/v1/products', $instance->toArray());
        $response
            ->assertCreated()
            ->assertJsonFragment([
                'description' => $instance->description,
            ]);
    }

    public function test_show_works() {
        $this->seed(ProductImageSeeder::class);
        $response = $this->get('/api/v1/products/1');
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'testProductOne',
            ]);
    }

    public function test_show_with_main_image_works() {
        $this->seed(ProductImageSeeder::class);
        $this->get('/api/v1/products/1?with_main_image=true')
            ->assertStatus(200)
            ->assertJsonFragment([
                'url' => 'www.thisIsATestingImageUrl.jpg',
            ]);
    }

    public function test_index_with_main_image_works() {
        $this->seed(ProductImageSeeder::class);
        $this->get('/api/v1/products?with_main_image=true')
            ->assertStatus(200)
            ->assertJsonFragment([
                'url' => 'www.thisIsATestingImageUrl.jpg',
            ])
            ->assertJsonCount(Product::count(), 'data');
    }
    public function test_index_works() {
        $this->seed(ProductSeeder::class);
        $this->get('/api/v1/products')
            ->assertStatus(200)
            ->assertJsonCount(10, 'data'); // TODO use a var instead of a magic number
    }

    public function test_delete_works() {
        $this->seed(ProductSeeder::class);
        $this->delete('api/v1/products/1')
            ->assertStatus(200);
        $this->assertEquals(Product::count(), 9);
    }
}
