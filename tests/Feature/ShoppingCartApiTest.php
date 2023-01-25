<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\CreatesApplication;

use Database\Seeders\ShoppingCartSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ProductImageSeeder;

use App\Models\User;

class ShoppingCartApiTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations, CreatesApplication;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_full_works()
    {
        $user = User::factory()->create()->save();
        $this->seed(ProductImageSeeder::class);
        $this->seed(ShoppingCartSeeder::class);
        $response = $this->get('api/v1/shopping-carts');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => 1,
            'amount' => 1,
            'product_id' => 1,
        ]);
    }
}
