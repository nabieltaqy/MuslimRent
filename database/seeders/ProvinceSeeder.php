<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([
            ['name' => 'Aceh'],
            ['name' => 'Bali'],
            ['name' => 'Banten'],
            ['name' => 'Bengkulu'],
            ['name' => 'Gorontalo'],
            ['name' => 'Jakarta'],
            ['name' => 'Jambi'],
            ['name' => 'Jawa Barat'],
            ['name' => 'Jawa Tengah'],
            ['name' => 'Jawa Timur'],
            ['name' => 'Kalimantan Barat'],
            ['name' => 'Kalimantan Tengah'],
            ['name' => 'Kalimantan Selatan'],
            ['name' => 'Kalimantan Timur'],
            ['name' => 'Kepulauan Bangka Belitung'],
            ['name' => 'Kepulauan Riau'],
            ['name' => 'Lampung'],
            ['name' => 'Maluku'],
            ['name' => 'Maluku Utara'],
            ['name' => 'Nusa Tenggara Barat'],
            ['name' => 'Nusa Tenggara Timur'],
            ['name' => 'Papua'],
            ['name' => 'Papua Barat'],
            ['name' => 'Riau'],
            ['name' => 'Sulawesi Barat'],
            ['name' => 'Sulawesi Tengah'],
            ['name' => 'Sulawesi Selatan'],
            ['name' => 'Sulawesi Utara'],
            ['name' => 'Sumatera Barat'],
            ['name' => 'Sumatera Selatan'],
            ['name' => 'Sumatera Utara'],
            ['name' => 'Yogyakarta'],
    ]);
    }
}
