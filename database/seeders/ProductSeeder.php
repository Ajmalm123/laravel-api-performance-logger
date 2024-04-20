<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Generate 500 records
        for ($i = 0; $i < 500; $i++) {
            Product::create([
                'category_id' => $faker->numberBetween(1, 10), // Assuming you have 10 categories
                'name' => $faker->words(3, true), // Generates a random string of 3 words
                'price' => $faker->randomFloat(2, 1, 100), // Generates a random float with 2 decimal places between 1 and 100
            ]);
        }
    }
}
