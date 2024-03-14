<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('services')->insert([
                'name' => $faker->word,
                'image' => 'https://cdn-icons-png.flaticon.com/512/3502/3502688.png',
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 5, 100),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
