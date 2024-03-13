<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategoryProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $categories = Category::all()->pluck('id')->toArray();
        $products = Product::all()->pluck('id')->toArray();

        foreach ($products as $product) {
            $categoriesToAttach = $faker->randomElements($categories, rand(1, 3));
            foreach ($categoriesToAttach as $category) {
                DB::table('category_product')->insert([
                    'category_id' => $category,
                    'product_id' => $product,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
