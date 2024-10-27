<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            // Aceh
            ['name' => 'Banda Aceh', 'province_id' => 1],
            ['name' => 'Langsa', 'province_id' => 1],
            ['name' => 'Lhokseumawe', 'province_id' => 1],
            ['name' => 'Sabang', 'province_id' => 1],

            // Bali
            ['name' => 'Denpasar', 'province_id' => 2],
            ['name' => 'Badung', 'province_id' => 2],
            ['name' => 'Gianyar', 'province_id' => 2],

            // Banten
            ['name' => 'Serang', 'province_id' => 3],
            ['name' => 'Tangerang', 'province_id' => 3],
            ['name' => 'Cilegon', 'province_id' => 3],

            // Bengkulu
            ['name' => 'Bengkulu', 'province_id' => 4],

            // Gorontalo
            ['name' => 'Gorontalo', 'province_id' => 5],

            // Jakarta
            ['name' => 'Jakarta Pusat', 'province_id' => 6],
            ['name' => 'Jakarta Utara', 'province_id' => 6],
            ['name' => 'Jakarta Barat', 'province_id' => 6],
            ['name' => 'Jakarta Selatan', 'province_id' => 6],
            ['name' => 'Jakarta Timur', 'province_id' => 6],

            // Jambi
            ['name' => 'Jambi', 'province_id' => 7],

            // Jawa Barat
            ['name' => 'Bandung', 'province_id' => 8],
            ['name' => 'Bekasi', 'province_id' => 8],
            ['name' => 'Depok', 'province_id' => 8],

            // Jawa Tengah
            ['name' => 'Semarang', 'province_id' => 9],
            ['name' => 'Surakarta', 'province_id' => 9],
            ['name' => 'Tegal', 'province_id' => 9],

            // Jawa Timur
            ['name' => 'Surabaya', 'province_id' => 10],
            ['name' => 'Malang', 'province_id' => 10],
            ['name' => 'Banyuwangi', 'province_id' => 10],

            // Kalimantan Barat
            ['name' => 'Pontianak', 'province_id' => 11],

            // Kalimantan Tengah
            ['name' => 'Palangkaraya', 'province_id' => 12],

            // Kalimantan Selatan
            ['name' => 'Banjarmasin', 'province_id' => 13],

            // Kalimantan Timur
            ['name' => 'Samarinda', 'province_id' => 14],

            // Kepulauan Bangka Belitung
            ['name' => 'Pangkal Pinang', 'province_id' => 15],

            // Kepulauan Riau
            ['name' => 'Batam', 'province_id' => 16],

            // Lampung
            ['name' => 'Bandar Lampung', 'province_id' => 17],

            // Maluku
            ['name' => 'Ambon', 'province_id' => 18],

            // Maluku Utara
            ['name' => 'Sofifi', 'province_id' => 19],

            // Nusa Tenggara Barat
            ['name' => 'Mataram', 'province_id' => 20],

            // Nusa Tenggara Timur
            ['name' => 'Kupang', 'province_id' => 21],

            // Papua
            ['name' => 'Jayapura', 'province_id' => 22],

            // Papua Barat
            ['name' => 'Manokwari', 'province_id' => 23],

            // Riau
            ['name' => 'Pekanbaru', 'province_id' => 24],

            // Sulawesi Barat
            ['name' => 'Mamuju', 'province_id' => 25],

            // Sulawesi Tengah
            ['name' => 'Palu', 'province_id' => 26],

            // Sulawesi Selatan
            ['name' => 'Makassar', 'province_id' => 27],

            // Sulawesi Utara
            ['name' => 'Manado', 'province_id' => 28],

            // Sumatera Barat
            ['name' => 'Padang', 'province_id' => 29],

            // Sumatera Selatan
            ['name' => 'Palembang', 'province_id' => 30],

            // Sumatera Utara
            ['name' => 'Medan', 'province_id' => 31],

            // Yogyakarta
            ['name' => 'Yogyakarta', 'province_id' => 32],
        ]);
    }
}
