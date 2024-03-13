<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('products')->insert([
                'name' => $faker->words(3, true),
                'image' => 'https://png.pngtree.com/png-vector/20210602/ourlarge/pngtree-3d-beauty-cosmetics-product-design-png-image_3350323.jpg',
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 5, 100),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
