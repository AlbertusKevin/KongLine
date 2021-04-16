<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
                'photoProfile' => 'images/profile/photo/default.png',
                'created_at' => Carbon::now(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('adminadmin'),
                'status' => 1,
                'role' => 'admin',
                'photoProfile' => 'images/profile/photo/default.png',
                'created_at' => Carbon::now(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'AdminAlbert',
                'email' => 'adminAlbert@gmail.com',
                'password' => Hash::make('adminalbert'),
                'status' => 1,
                'role' => 'admin',
                'photoProfile' => 'images/profile/photo/FotoAlbertus1.png',
                'created_at' => Carbon::now(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Participant',
                'email' => 'participant@gmail.com',
                'password' => Hash::make('participant'),
                'status' => 1,
                'role' => 'participant',
                'photoProfile' => 'images/profile/photo/default.png',
                'created_at' => Carbon::now(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Tony Stark',
                'email' => 'tonystark@gmail.com',
                'password' => Hash::make('tonystark'),
                'status' => 1,
                'role' => 'participant',
                'countEvent' => 5,
                'photoProfile' => 'images/profile/photo/tonystark.jpg',
                'created_at' => Carbon::create('2021', '03', '23'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Wanda Maximoff',
                'email' => 'wanda@gmail.com',
                'password' => Hash::make('wanda'),
                'status' => 1,
                'role' => 'participant',
                'countEvent' => 2,
                'photoProfile' => 'images/profile/photo/wanda.jpg',
                'created_at' => Carbon::create('2021', '03', '30'),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'hizkia',
                'email' => 'hizkia@gmail.com',
                'password' => Hash::make('hizkia'),
                'status' => 1,
                'role' => 'participant',
                'countEvent' => 3,
                'photoProfile' => 'images/profile/photo/hizkia.jpg',
                'created_at' => Carbon::create('2021', '03', '20'),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Mikhael',
                'email' => 'mikhael@gmail.com',
                'password' => Hash::make('mikhael'),
                'status' => 1,
                'role' => 'participant',
                'countEvent' => 1,
                'photoProfile' => 'images/profile/photo/mikhael.jpg',
                'created_at' => Carbon::now(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'yaoming',
                'email' => 'yaoming@gmail.com',
                'password' => Hash::make('yaoming'),
                'status' => 1,
                'role' => 'participant',
                'countEvent' => 4,
                'photoProfile' => 'images/profile/photo/yaoming.png',
                'created_at' => Carbon::create('2021', '03', '25'),
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
                'photoProfile' => 'images/profile/photo/default.png',
                'created_at' => Carbon::create('2021', '03', '23'),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Cristiano',
                'email' => 'cristiano@gmail.com',
                'password' => Hash::make('cristiano'),
                'status' => 1,
                'role' => 'campaigner',
                'ktpPicture' => 'images/ktp/cristianoKtp.JPG',
                'nik' => '111222333444542',
                'accountNumber' => '1404514045',
                'countEvent' => 3,
                'photoProfile' => 'images/profile/photo/Cristiano.jpg',
                'created_at' => Carbon::now(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Motomoto',
                'email' => 'motomoto@gmail.com',
                'password' => Hash::make('motomoto'),
                'status' => 1,
                'role' => 'campaigner',
                'ktpPicture' => 'images/ktp/motomotoKTP.jpg',
                'nik' => '111222333444938',
                'accountNumber' => '0987654321',
                'countEvent' => 1,
                'photoProfile' => 'images/profile/photo/motomoto.jpg',
                'created_at' => Carbon::now(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Gargantuar Zombie',
                'email' => 'gargantuar@gmail.com',
                'password' => Hash::make('gargantuar'),
                'status' => 1,
                'role' => 'campaigner',
                'ktpPicture' => 'images/ktp/gargantuarZombie.jpg',
                'nik' => '111222333444939',
                'accountNumber' => '0987654354',
                'countEvent' => 3,
                'photoProfile' => 'images/profile/photo/gargantuar.png',
                'created_at' => Carbon::create('2021', '03', '29'),
            ]
        );
    }
}
