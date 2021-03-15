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
        DB::table('users')->insert(
            [
                'name' => 'Guest',
                'email' => '',
                'password' => '',
                'status' => 1,
                'role' => 'guest',
                'photoProfile' => 'images/profile/photo/default.png'
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('admin'),
                'status' => 1,
                'role' => 'admin',
                'photoProfile' => 'images/profile/photo/default.png'
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Participant',
                'email' => 'participant@gmail.com',
                'password' => Hash::make('participant'),
                'status' => 1,
                'role' => 'participant',
                'photoProfile' => 'images/profile/photo/default.png'
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Campaigner',
                'email' => 'campaigner@gmail.com',
                'password' => Hash::make('campaigner'),
                'status' => 1,
                'role' => 'campaigner',
                'ktpPicture' => 'images/ktp/ktp011.jpg',
                'nik' => '111222333444555',
                'accountNumber' => '1234567890',
                'photoProfile' => 'images/profile/photo/default.png'
            ]
        );
    }
}
