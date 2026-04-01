<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $kodeJurusan = '55201';

        for ($i = 1; $i <= 50; $i++) {
            $angkatan = $faker->numberBetween(21, 25);

            $urutan = str_pad($i, 3, '0', STR_PAD_LEFT);

            $npm = $kodeJurusan . $angkatan . $urutan;

            DB::table('users')->insert([
                'npm' => (int) $npm,
                'username' => $faker->unique()->userName,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
