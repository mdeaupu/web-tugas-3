<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $returnedLoans = DB::table('loan_detail')->where('is_return', true)->get();

        foreach ($returnedLoans as $detail) {
            $charge = $faker->boolean(30); // 30% kena denda
            DB::table('returns')->insert([
                'loan_detail_id' => $detail->id,
                'charge' => $charge,
                'amount' => $charge ? 5000 : 0,
            ]);
        }
    }
}
