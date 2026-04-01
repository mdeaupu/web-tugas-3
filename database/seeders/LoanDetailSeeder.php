<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LoanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 50; $i++) {
            DB::table('loan_detail')->insert([
                'loan_id' => $i,
                'book_id' => $faker->numberBetween(1, 50),
                'is_return' => $faker->boolean(50), // 50% kemungkinan sudah kembali
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
