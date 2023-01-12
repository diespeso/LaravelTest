<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\ProductReview;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: maybe check if product seeder ran and do differente stuff depending on that?
        $staticReview = new ProductReview([
            'product_id' => 1,
            'title' => 'testSecondReview',
            'content' => 'reviewTwoTest',
            'score' => 3,
        ]);
        $staticReview->save();
        ProductReview::factory()->count(10)->create();
    }
}
