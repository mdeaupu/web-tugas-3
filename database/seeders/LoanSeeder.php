<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = DB::table('users')->pluck('npm')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('loans')->insert([
                'user_npm' => $faker->randomElement($users),
                'loan_at' => now()->subDays($faker->numberBetween(5, 10)),
                'return_at' => now()->addDays($faker->numberBetween(1, 7)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
