<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

use App\Models\Product;

use App\Models\ProductReview;
// product review seeder
use Database\Seeders\ProductReviewSeeder;
use Database\Seeders\ProductSeeder;

class ProductReviewApiTest extends TestCase
{
    use RefreshDatabase, CreatesApplication, DatabaseMigrations;
    public function test_index_works_with_info() {
        $this->seed(ProductSeeder::class);
        $this->seed(ProductReviewSeeder::class);

        $this->get('api/v1/products/1/product-reviews')
            ->assertStatus(200)
            ->assertJsonStructure(['info' => ['average' => [], 'count' => []]]);
    }
}
