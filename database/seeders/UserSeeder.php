<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'), // Password yang di-hash
                'Role' => 'Admin',
                'city_id' => 1,
                'phone' => '08123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('12345678'), // Password yang di-hash
                'Role' => 'Anggota',
                'city_id' => 1,
                'phone' => '0834543219',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
