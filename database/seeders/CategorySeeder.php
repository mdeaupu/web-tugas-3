<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Sains', 'Teknologi', 'Novel', 'Sejarah', 'Agama'];
        foreach ($categories as $c) {
            \DB::table('categories')->insert(['category' => $c]);
        }
    }
}
