<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder {

    public function run() {
        $staticCategory1 = new Category([
            'name' => 'Electronics',
        ]);
        $staticCategory1->save();
        $staticCategory1->refresh();

        $staticCategory2 = new Category([
            'name' => 'Videogames',
        ]);
        $staticCategory2->save();
        $staticCategory2->refresh();
    }
}