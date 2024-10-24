<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_unit')->insert([
            [
                'category_id' => 1, // Sesuaikan dengan ID kategori yang ada
                'unit_id' => 1,     // Sesuaikan dengan ID unit yang ada
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'unit_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2, // Misal kategori kedua
                'unit_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'unit_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3, // Misal kategori ketiga
                'unit_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}