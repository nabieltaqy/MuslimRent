<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'Sajadah',
                'description' => 'Alat yang digunakan sebagai alas untuk solat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Sarung',
                'description' => 'Kain yang digunakan untuk menutup aurat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Tasbih',
                'description' => 'Butir-butir yang digunakan untuk menghitung dzikir.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Peci',
                'description' => 'Penutup yang digunakan untuk menutupi kepala saat solat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Air Wudhu',
                'description' => 'Air yang digunakan untuk bersuci sebelum solat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
