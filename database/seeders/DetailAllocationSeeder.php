<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Donation 1
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 1,
                'nominal' => 100000000,
                'description' => 'Donation 1 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 1,
                'nominal' => 20000000,
                'description' => 'Donation 1 Alokasi 2'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 1,
                'nominal' => 15000000,
                'description' => 'Donation 1 Alokasi 3'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 1,
                'nominal' => 10000000,
                'description' => 'Donation 1 Alokasi 4'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 1,
                'nominal' => 5000000,
                'description' => 'Donation 1 Alokasi 5'
            ]
        );

        // donation 2
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 2,
                'nominal' => 25000000,
                'description' => 'Donation 2 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 2,
                'nominal' => 5000000,
                'description' => 'Donation 2 Alokasi 2'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 2,
                'nominal' => 10000000,
                'description' => 'Donation 2 Alokasi 3'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 2,
                'nominal' => 10000000,
                'description' => 'Donation 2 Alokasi 4'
            ]
        );

        // donation 3
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 3,
                'nominal' => 25000000,
                'description' => 'Donation 3 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 3,
                'nominal' => 5000000,
                'description' => 'Donation 3 Alokasi 2'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 3,
                'nominal' => 50000000,
                'description' => 'Donation 3 Alokasi 3'
            ]
        );

        // donation 4
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 4,
                'nominal' => 20000000,
                'description' => 'Donation 4 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 4,
                'nominal' => 20000000,
                'description' => 'Donation 4 Alokasi 2'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 4,
                'nominal' => 30000000,
                'description' => 'Donation 4 Alokasi 3'
            ]
        );

        // donation 5
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 5,
                'nominal' => 180000000,
                'description' => 'Donation 5 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 5,
                'nominal' => 20000000,
                'description' => 'Donation 5 Alokasi 2'
            ]
        );

        // donation 6
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 6,
                'nominal' => 100000000,
                'description' => 'Donation 6 Alokasi 1'
            ]
        );

        // donation 7
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 7,
                'nominal' => 20000000,
                'description' => 'Donation 7 Alokasi 1'
            ]
        );

        // donation 8
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 8,
                'nominal' => 8000000,
                'description' => 'Donation 8 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 8,
                'nominal' => 2000000,
                'description' => 'Donation 8 Alokasi 2'
            ]
        );

        // donation 9
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 9,
                'nominal' => 3000000,
                'description' => 'Donation 9 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 9,
                'nominal' => 7000000,
                'description' => 'Donation 9 Alokasi 2'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 9,
                'nominal' => 1000000,
                'description' => 'Donation 9 Alokasi 3'
            ]
        );

        // donation 10
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 10,
                'nominal' => 8000000,
                'description' => 'Donation 10 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 10,
                'nominal' => 7000000,
                'description' => 'Donation 10 Alokasi 2'
            ]
        );

        // donation 11
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 11,
                'nominal' => 8000000,
                'description' => 'Donation 11 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 11,
                'nominal' => 8000000,
                'description' => 'Donation 11 Alokasi 2'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 11,
                'nominal' => 4000000,
                'description' => 'Donation 11 Alokasi 3'
            ]
        );

        // donation 12
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 12,
                'nominal' => 20000000,
                'description' => 'Donation 12 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 12,
                'nominal' => 15000000,
                'description' => 'Donation 12 Alokasi 2'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 12,
                'nominal' => 15000000,
                'description' => 'Donation 12 Alokasi 3'
            ]
        );

        // donation 13
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 13,
                'nominal' => 20000000,
                'description' => 'Donation 13 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 13,
                'nominal' => 30000000,
                'description' => 'Donation 13 Alokasi 2'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 13,
                'nominal' => 40000000,
                'description' => 'Donation 13 Alokasi 3'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 13,
                'nominal' => 10000000,
                'description' => 'Donation 13 Alokasi 4'
            ]
        );

        // donation 14
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 14,
                'nominal' => 20000000,
                'description' => 'Donation 14 Alokasi 1'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 14,
                'nominal' => 5000000,
                'description' => 'Donation 14 Alokasi 2'
            ]
        );

        // donation 15
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 15,
                'nominal' => 90000000,
                'description' => 'Donation 15 Alokasi 1'
            ]
        );

        // donation 16
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 16,
                'nominal' => 150000000,
                'description' => 'Donation 16 Alokasi 1'
            ]
        );

        // donation 17
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 17,
                'nominal' => 100000000,
                'description' => 'Donation 17 Alokasi 1'
            ]
        );

        // donation 18
        DB::table('detail_allocation')->insert(
            [
                'idDonation' => 18,
                'nominal' => 50000000,
                'description' => 'Donation 18 Alokasi 1'
            ]
        );
    }
}
