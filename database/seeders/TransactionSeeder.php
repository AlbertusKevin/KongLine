<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction')->insert(
            [
                'idDonation' => 1,
                'idParticipant' => 4,
                'accountNumber' => '209708591042',
                'nominal' => 10000,
                'repaymentPicture' => 'images/buktitrf.jpg',
                'status' => 2,
                'annonymous_donate' => 0,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 1,
                'idParticipant' => 6,
                'accountNumber' => '209708591239',
                'nominal' => 10000,
                'repaymentPicture' => 'images/buktitrf.jpg',
                'status' => 1,
                'annonymous_donate' => 1,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 11,
                'accountNumber' => '209708695099',
                'nominal' => 100000,
                'repaymentPicture' => 'images/buktitrf.jpg',
                'status' => 0,
                'annonymous_donate' => 1,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 7,
                'idParticipant' => 6,
                'accountNumber' => '209245591099',
                'nominal' => 14000,
                'repaymentPicture' => 'images/buktitrf.jpg',
                'status' => 0,
                'annonymous_donate' => 0,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
