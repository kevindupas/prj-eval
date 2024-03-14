<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('brands')->insert([
                'name' => $faker->words(3, true),
                'logo' => 'https://png.pngtree.com/png-vector/20210602/ourlarge/pngtree-3d-beauty-cosmetics-product-design-png-image_3350323.jpg',
                'partner' => $faker->boolean(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
