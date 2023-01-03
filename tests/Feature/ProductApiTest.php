<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;

use Tests\CreatesApplication;
use Tests\TestCase;

use App\Models\Product;

class ProductApi extends TestCase
{
    use CreatesApplication, DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();
        Artisan::call('db:seed');
    }
    /* public function test_one() {
        $response = $this->get('/api/v1/products');
        $response->assertJson([
            'data' => [],
        ]);
    } */

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

    public function test_get_one() {
        $response = $this->get('/api/v1/products/1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => null,
            ]);
    }
}
