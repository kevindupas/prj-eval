<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BrandProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $brands = Brand::all()->pluck('id')->toArray();
        $products = Product::all()->pluck('id')->toArray();

        foreach ($products as $product) {
            $categoriesToAttach = $faker->randomElements($products, rand(1, 3));
            foreach ($categoriesToAttach as $brand) {
                DB::table('brand_product')->insert([
                    'brand_id' => $brand,
                    'product_id' => $product,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
