<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            DB::table('books')->insert([
                'title' => $faker->sentence(3),
                'author' => $faker->name,
                'year' => $faker->year,
                'publisher' => $faker->company,
                'city' => $faker->city,
                'cover' => 'default.jpg',
                'bookshelf_id' => $faker->numberBetween(1, 5),
                'category_id' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
