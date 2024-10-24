<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            [
                'kode_unit' => 'U001',
                'nama_unit' => 'Sajadah Berwarna',
                'qty' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_unit' => 'U002',
                'nama_unit' => 'Mikbah Kayu',
                'qty' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_unit' => 'U003',
                'nama_unit' => 'Tasbih Kayu',
                'qty' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_unit' => 'U012',
                'nama_unit' => 'Tasbih Plastik',
                'qty' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_unit' => 'U004',
                'nama_unit' => 'Kain Penutup Kepala Putih',
                'qty' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_unit' => 'U005',
                'nama_unit' => 'Air Wudhu Botol',
                'qty' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
