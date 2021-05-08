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
                'backgroundPicture' => 'images/profile/background/default-cover-profile.png',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'First Administrator',
                'email' => 'admin_1@gmail.com',
                'password' => Hash::make('admin1'),
                'status' => 1,
                'role' => 'admin',
                'photoProfile' => 'images/profile/photo/default.png',
                'backgroundPicture' => 'images/profile/background/default-cover-profile.png',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
                'phoneNumber' => '081286549876',
                'dob' => Carbon::createFromDate(1995, 10, 07, '+7:00'),
                'photoProfile' => 'images/profile/photo/default.png',
                'backgroundPicture' => 'images/profile/background/Black Galaxy PC Wallpaper.jpg',
                'linkProfile' => 'admin.com',
                'aboutMe' => 'Loren Ipsum Loren Ipsum',
                'address' => 'Jalanin aja dulu no. 10',
                'city' => 'Pekanbaru',
                'country' => 'Indonesia',
                'zipCode' => '49328',
                'job' => 'admin',
                'gender' => "male",
                'ktpPicture' => 'images/profile/KTP/KTP.jpg',
                'nik' => '0123456789012345',
                'accountNumber' => '777865954',
            ]
        );
    }
}
