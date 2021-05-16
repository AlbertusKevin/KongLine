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
        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Guest ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // Guest, ID = 1
        DB::table('users')->insert(
            [
                'name' => GUEST,
                'email' => '',
                'password' => '',
                'status' => ACTIVE,
                'role' => GUEST,
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Admin ~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================

        // Admin 1, ID = 2
        DB::table('users')->insert(
            [
                'name' => 'First Administrator',
                'email' => 'admin_1@gmail.com',
                'password' => Hash::make('admin1'),
                'status' => ACTIVE,
                'role' => ADMIN,
                'phoneNumber' => '081286549876',
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'aboutMe' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae, sit?',
                'address' => 'Jl. Soekarno Hatta 253',
                'city' => 'Bandung',
                'country' => 'Indonesia',
                'zipCode' => '40255',
                'gender' => "male",
                'nik' => '0123456789012345',
                'accountNumber' => ACCOUNT,
                'dob' => Carbon::create("1995", "10", "07"),
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // Admin 2, ID = 3
        DB::table('users')->insert(
            [
                'name' => 'Second Administrator',
                'email' => 'admin_2@gmail.com',
                'password' => Hash::make('admin2'),
                'status' => ACTIVE,
                'role' => ADMIN,
                'phoneNumber' => '0834555778890',
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'aboutMe' => 'Lorem ipsum dolor sit amet.',
                'address' => 'Jl. Otista no. 35',
                'city' => 'Bandung',
                'country' => 'Indonesia',
                'zipCode' => '40228',
                'gender' => "female",
                'nik' => '1122330987654321',
                'accountNumber' => ACCOUNT,
                'dob' => Carbon::create("1990", "10", "17"),
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~~~~ Participant ~~~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        //todo: seeder -> 'countEvent' => 0,

        //participant 1, ID = 4
        DB::table('users')->insert(
            [
                'name' => 'Albertus Kevin',
                'email' => 'vinalbertus@gmail.com',
                'password' => Hash::make('Albertus Kevin'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'phoneNumber' => '089709871234',
                'dob' => Carbon::create("2000", "10", "07"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'linkProfile' => 'https://albertuskevin.github.io',
                'aboutMe' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum, delectus!',
                'address' => 'Jl. Jend. Sudirman 98',
                'city' => 'Jakarta',
                'country' => 'Indonesia',
                'zipCode' => '40995',
                'job' => 'Web Developer',
                'gender' => "male",
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //participant 2, ID = 5
        DB::table('users')->insert(
            [
                'name' => 'Participant Kedua',
                'email' => 'participant_2@gmail.com',
                'password' => Hash::make('Participant Kedua'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'dob' => Carbon::create("2000", "10", "07"),
                'photoProfile' => '/images/profile/photo/participant-2.jpg',
                'backgroundPicture' => '/images/profile/background/cover-part-2.jpg',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //participant 3, ID = 6
        DB::table('users')->insert(
            [
                'name' => 'Participant Ketiga',
                'email' => 'participant_3@gmail.com',
                'password' => Hash::make('Participant Ketiga'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'dob' => Carbon::create("2004", "03", "27"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //participant 4, ID = 7
        DB::table('users')->insert(
            [
                'name' => 'Participant Keempat',
                'email' => 'participant_4@gmail.com',
                'password' => Hash::make('Participant Keempat'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'dob' => Carbon::create("1990", "05", "08"),
                'photoProfile' => '//images/profile/photo/participant-4.jpg',
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //participant 5, ID = 8
        DB::table('users')->insert(
            [
                'name' => 'Participant Kelima',
                'email' => 'participant_5@gmail.com',
                'password' => Hash::make('Participant Kelima'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'dob' => Carbon::create("1980", "01", "28"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //participant 6, ID = 9
        DB::table('users')->insert(
            [
                'name' => 'Participant Keenam',
                'email' => 'participant_6@gmail.com',
                'password' => Hash::make('Participant Keenam'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'dob' => Carbon::create("1987", "02", "08"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //participant 7, ID = 10
        DB::table('users')->insert(
            [
                'name' => 'Participant Ketujuh',
                'email' => 'participant_7@gmail.com',
                'password' => Hash::make('Participant Ketujuh'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'dob' => Carbon::create("1992", "11", "18"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //participant 8, ID = 11
        DB::table('users')->insert(
            [
                'name' => 'Participant Kedelapan',
                'email' => 'participant_8@gmail.com',
                'password' => Hash::make('Participant Kedelapan'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'dob' => Carbon::create("1982", "06", "18"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //participant 9, ID = 12
        DB::table('users')->insert(
            [
                'name' => 'Participant Kesembilan',
                'email' => 'participant_9@gmail.com',
                'password' => Hash::make('Participant Kesembilan'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'dob' => Carbon::create("1994", "09", "25"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //participant 10, ID = 13
        DB::table('users')->insert(
            [
                'name' => 'Participant Kesepuluh',
                'email' => 'participant_10@gmail.com',
                'password' => Hash::make('Participant Kesepuluh'),
                'status' => ACTIVE,
                'role' => PARTICIPANT,
                'dob' => Carbon::create("2005", "10", "15"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~~~~~ Campaigner ~~~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        //todo: seeder -> 'countEvent' => 0,

        // campaigner 1, ID = 14
        DB::table('users')->insert(
            [
                'name' => 'Vern Campaigner',
                'email' => 'albertusk.vr46@gmail.com',
                'password' => Hash::make('Vern Campaigner'),
                'status' => ACTIVE,
                'role' => CAMPAIGNER,
                'phoneNumber' => '089766766281',
                'dob' => Carbon::create("2000", "04", "30"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'aboutMe' => 'Lorem ipsum dolor sit amet consectetur elit. Dicta, cupiditate at voluptate quod itaque atque. Lorem, ipsum.',
                'address' => 'Jl. Lengkong Besar no. 24',
                'city' => 'Bandung',
                'country' => 'Indonesia',
                'zipCode' => '40220',
                'job' => 'Mahasiswa',
                'gender' => "female",
                'ktpPicture' => '/images/verification/ktp/campaigner-4.jpg',
                'nik' => '9999111133332222',
                'accountNumber' => '67467839279',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // campaigner 2, ID = 15
        DB::table('users')->insert(
            [
                'name' => 'Campaigner Kedua',
                'email' => 'campaigner_2@gmail.com',
                'password' => Hash::make('Campaigner Kedua'),
                'status' => ACTIVE,
                'role' => CAMPAIGNER,
                'phoneNumber' => '08765897231',
                'dob' => Carbon::create("1995", "08", "30"),
                'photoProfile' => '/images/profile/photo/campaigner-2.png',
                'backgroundPicture' => '/images/profile/background/cover-camp-2.jpg',
                'aboutMe' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, praesentium eaque cupiditate at voluptate quod itaque atque.',
                'address' => 'Jl. Kebayoran Baru 23',
                'city' => 'Jakarta',
                'country' => 'Indonesia',
                'zipCode' => '48880',
                'job' => 'Dokter Gigi',
                'gender' => "female",
                'ktpPicture' => '/images/verification/ktp/campaigner-2.jpg',
                'nik' => '4444222211113333',
                'accountNumber' => '0987573683',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // campaigner 3, ID = 16
        DB::table('users')->insert(
            [
                'name' => 'Campaigner Ketiga',
                'email' => 'campaigner_3@gmail.com',
                'password' => Hash::make('Campaigner Ketiga'),
                'status' => ACTIVE,
                'role' => CAMPAIGNER,
                'phoneNumber' => '089272981657',
                'dob' => Carbon::create("1980", "12", "20"),
                'photoProfile' => '/images/profile/photo/campaigner-3.jpg',
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'aboutMe' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, praesentium eaque cupiditate at voluptate quod itaque atque. Lorem, ipsum.',
                'address' => 'Jl. Kebayoran Lama no. 4',
                'city' => 'Jakarta',
                'country' => 'Indonesia',
                'zipCode' => '43380',
                'job' => 'Dosen',
                'gender' => "male",
                'ktpPicture' => '/images/verification/ktp/campaigner-3.png',
                'nik' => '2222444433331111',
                'accountNumber' => '98569268123',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // campaigner 4, ID = 17
        DB::table('users')->insert(
            [
                'name' => 'Campaigner Keempat',
                'email' => 'campaigner_4@gmail.com',
                'password' => Hash::make('Campaigner Keempat'),
                'status' => ACTIVE,
                'role' => CAMPAIGNER,
                'phoneNumber' => '087283878798',
                'dob' => Carbon::create("2000", "11", "25"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'aboutMe' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, praesentium eaque cupiditate at voluptate quod itaque atque. Possimus, eaque fuga!',
                'address' => 'Jl. Ponti 23',
                'city' => 'Pontianak',
                'country' => 'Indonesia',
                'zipCode' => '49808',
                'job' => 'Kasir',
                'gender' => "female",
                'ktpPicture' => '/images/verification/ktp/campaigner-1.jpg',
                'nik' => '1111222233334444',
                'accountNumber' => '1234567890',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // campaigner 5, ID = 18
        DB::table('users')->insert(
            [
                'name' => 'Campaigner Kelima',
                'email' => 'campaigner_5@gmail.com',
                'password' => Hash::make('Campaigner Kelima'),
                'status' => ACTIVE,
                'role' => CAMPAIGNER,
                'phoneNumber' => '084877772231',
                'dob' => Carbon::create("1997", "10", "20"),
                'photoProfile' => DEFAULT_PROFILE,
                'backgroundPicture' => DEFAULT_COVER_PROFILE,
                'aboutMe' => 'Lorem ipsum dolor sit amet consectetur elit. Dicta, cupiditate at voluptate quod itaque atque. Lorem, ipsum.',
                'address' => 'Jl. Asia Afrika no. 34',
                'city' => 'Bandung',
                'country' => 'Indonesia',
                'zipCode' => '40230',
                'job' => 'Polisi',
                'gender' => "male",
                'ktpPicture' => '/images/verification/ktp/campaigner-5.jpg',
                'nik' => '8888222266665555',
                'accountNumber' => '276640273048',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );
    }
}
