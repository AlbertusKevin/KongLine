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
        //donation 5, 10 donate
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 4,
                'nominal' => 20000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-1.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(5),
                'updated_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 5,
                'nominal' => 10000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-2.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(4),
                'updated_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 6,
                'nominal' => 10000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-3.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(4),
                'updated_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 8,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-4.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(3),
                'updated_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 10,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-5.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(6),
                'updated_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 12,
                'nominal' => 7000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-6.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(3),
                'updated_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 14,
                'nominal' => 8000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-7.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(5),
                'updated_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 16,
                'nominal' => 15000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-8.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(4),
                'updated_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 17,
                'nominal' => 50000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-9.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(5),
                'updated_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 5,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 18,
                'nominal' => 80000000,
                'repaymentPicture' => '/images/verification/transaction/title-fifth-donation/transfer-10.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(6),
                'updated_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );

        // donation 6, 6 donate
        DB::table('transaction')->insert(
            [
                'idDonation' => 6,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 18,
                'nominal' => 7000000,
                'repaymentPicture' => '/images/verification/transaction/title-sixth-donation/transfer-1.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(3),
                'updated_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 6,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 4,
                'nominal' => 2000000,
                'repaymentPicture' => '/images/verification/transaction/title-sixth-donation/transfer-2.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(3),
                'updated_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 6,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 5,
                'nominal' => 3000000,
                'repaymentPicture' => '/images/verification/transaction/title-sixth-donation/transfer-3.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(2),
                'updated_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 6,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 6,
                'nominal' => 3000000,
                'repaymentPicture' => '/images/verification/transaction/title-sixth-donation/transfer-4.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(2),
                'updated_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 6,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 7,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-sixth-donation/transfer-5.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(),
                'updated_at' => Carbon::now('+7:00')->subDay()
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 6,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 8,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-sixth-donation/transfer-6.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDay(),
                'updated_at' => Carbon::now('+7:00')->subDay()
            ]
        );

        //donation 7, collected 5000.000, donate 4
        DB::table('transaction')->insert(
            [
                'idDonation' => 7,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 9,
                'nominal' => 2500000,
                'repaymentPicture' => '/images/verification/transaction/title-seventh-donation/transfer-1.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 7,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 10,
                'nominal' => 500000,
                'repaymentPicture' => '/images/verification/transaction/title-seventh-donation/transfer-2.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 7,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 11,
                'nominal' => 1000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventh-donation/transfer-3.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 7,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 12,
                'nominal' => 1000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventh-donation/transfer-4.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );

        //donation 8, collected 500.000, donate 2
        DB::table('transaction')->insert(
            [
                'idDonation' => 8,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 13,
                'nominal' => 200000,
                'repaymentPicture' => '/images/verification/transaction/title-eigth-donation/transfer-1.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 8,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 14,
                'nominal' => 300000,
                'repaymentPicture' => '/images/verification/transaction/title-eigth-donation/transfer-2.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );

        //donation 9, collected 25.000.000, donate 5
        DB::table('transaction')->insert(
            [
                'idDonation' => 9,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 15,
                'nominal' => 15000000,
                'repaymentPicture' => '/images/verification/transaction/title-ninth-donation/transfer-1.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(8),
                'updated_at' => Carbon::now('+7:00')->subDays(8)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 9,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 16,
                'nominal' => 500000,
                'repaymentPicture' => '/images/verification/transaction/title-ninth-donation/transfer-2.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(5),
                'updated_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 9,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 17,
                'nominal' => 50000,
                'repaymentPicture' => '/images/verification/transaction/title-ninth-donation/transfer-3.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(3),
                'updated_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 9,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 18,
                'nominal' => 450000,
                'repaymentPicture' => '/images/verification/transaction/title-ninth-donation/transfer-4.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(),
                'updated_at' => Carbon::now('+7:00')->subDay()
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 9,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 4,
                'nominal' => 9000000,
                'repaymentPicture' => '/images/verification/transaction/title-ninth-donation/transfer-5.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDay(),
                'updated_at' => Carbon::now('+7:00')->subDay()
            ]
        );

        //donation 10, collected 10.000.000, donate 8
        DB::table('transaction')->insert(
            [
                'idDonation' => 10,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 5,
                'nominal' => 10000,
                'repaymentPicture' => '/images/verification/transaction/title-tenth-donation/transfer-1.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(16),
                'updated_at' => Carbon::now('+7:00')->subDays(16)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 10,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 6,
                'nominal' => 20000,
                'repaymentPicture' => '/images/verification/transaction/title-tenth-donation/transfer-2.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(16),
                'updated_at' => Carbon::now('+7:00')->subDays(16)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 10,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 7,
                'nominal' => 30000,
                'repaymentPicture' => '/images/verification/transaction/title-tenth-donation/transfer-3.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(15),
                'updated_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 10,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 8,
                'nominal' => 6000000,
                'repaymentPicture' => '/images/verification/transaction/title-tenth-donation/transfer-4.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(13),
                'updated_at' => Carbon::now('+7:00')->subDays(13)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 10,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 9,
                'nominal' => 100000,
                'repaymentPicture' => '/images/verification/transaction/title-tenth-donation/transfer-5.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(10),
                'updated_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 10,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 10,
                'nominal' => 40000,
                'repaymentPicture' => '/images/verification/transaction/title-tenth-donation/transfer-6.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(8),
                'updated_at' => Carbon::now('+7:00')->subDays(8)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 10,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 11,
                'nominal' => 800000,
                'repaymentPicture' => '/images/verification/transaction/title-tenth-donation/transfer-7.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(7),
                'updated_at' => Carbon::now('+7:00')->subDays(7)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 10,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 12,
                'nominal' => 3000000,
                'repaymentPicture' => '/images/verification/transaction/title-tenth-donation/transfer-8.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(6),
                'updated_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );

        //donation 11, collected 15.000.000, donate 8
        DB::table('transaction')->insert(
            [
                'idDonation' => 11,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 13,
                'nominal' => 250000,
                'repaymentPicture' => '/images/verification/transaction/title-eleventh-donation/transfer-1.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(11),
                'updated_at' => Carbon::now('+7:00')->subDays(11)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 11,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 14,
                'nominal' => 500000,
                'repaymentPicture' => '/images/verification/transaction/title-eleventh-donation/transfer-2.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(10),
                'updated_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 11,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 15,
                'nominal' => 4050000,
                'repaymentPicture' => '/images/verification/transaction/title-eleventh-donation/transfer-3.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(9),
                'updated_at' => Carbon::now('+7:00')->subDays(9)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 11,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 16,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-eleventh-donation/transfer-4.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(8),
                'updated_at' => Carbon::now('+7:00')->subDays(8)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 11,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 17,
                'nominal' => 1100000,
                'repaymentPicture' => '/images/verification/transaction/title-eleventh-donation/transfer-5.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(6),
                'updated_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 11,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 18,
                'nominal' => 100000,
                'repaymentPicture' => '/images/verification/transaction/title-eleventh-donation/transfer-6.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(6),
                'updated_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 11,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 4,
                'nominal' => 800000,
                'repaymentPicture' => '/images/verification/transaction/title-eleventh-donation/transfer-7.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(4),
                'updated_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 11,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 5,
                'nominal' => 3200000,
                'repaymentPicture' => '/images/verification/transaction/title-eleventh-donation/transfer-8.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(2),
                'updated_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );

        //donation 12, collected 10.000.000, donate 5
        DB::table('transaction')->insert(
            [
                'idDonation' => 12,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 6,
                'nominal' => 300000,
                'repaymentPicture' => '/images/verification/transaction/title-twelfth-donation/transfer-1.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(13),
                'updated_at' => Carbon::now('+7:00')->subDays(13)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 12,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 7,
                'nominal' => 350000,
                'repaymentPicture' => '/images/verification/transaction/title-twelfth-donation/transfer-2.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(10),
                'updated_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 12,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 8,
                'nominal' => 4500000,
                'repaymentPicture' => '/images/verification/transaction/title-twelfth-donation/transfer-3.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(9),
                'updated_at' => Carbon::now('+7:00')->subDays(9)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 12,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 9,
                'nominal' => 2000000,
                'repaymentPicture' => '/images/verification/transaction/title-twelfth-donation/transfer-4.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(5),
                'updated_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 12,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 10,
                'nominal' => 2850000,
                'repaymentPicture' => '/images/verification/transaction/title-twelfth-donation/transfer-5.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(2),
                'updated_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );

        //donation 13, collected 25.000.000, donate 3
        DB::table('transaction')->insert(
            [
                'idDonation' => 13,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 11,
                'nominal' => 10000000,
                'repaymentPicture' => '/images/verification/transaction/title-thirteenth-donation/transfer-1.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(9),
                'updated_at' => Carbon::now('+7:00')->subDays(9)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 13,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 12,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-thirteenth-donation/transfer-2.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(6),
                'updated_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 13,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 13,
                'nominal' => 10000000,
                'repaymentPicture' => '/images/verification/transaction/title-thirteenth-donation/transfer-3.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(3),
                'updated_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );

        //donation 14, collected 20.000.000, donate 6
        DB::table('transaction')->insert(
            [
                'idDonation' => 14,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 14,
                'nominal' => 1000000,
                'repaymentPicture' => '/images/verification/transaction/title-fourteenth-donation/transfer-1.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(26),
                'updated_at' => Carbon::now('+7:00')->subDays(26)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 14,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 15,
                'nominal' => 2000000,
                'repaymentPicture' => '/images/verification/transaction/title-fourteenth-donation/transfer-2.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(22),
                'updated_at' => Carbon::now('+7:00')->subDays(22)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 14,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 16,
                'nominal' => 3000000,
                'repaymentPicture' => '/images/verification/transaction/title-fourteenth-donation/transfer-3.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(12),
                'updated_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 14,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 17,
                'nominal' => 4000000,
                'repaymentPicture' => '/images/verification/transaction/title-fourteenth-donation/transfer-4.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(10),
                'updated_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 14,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 18,
                'nominal' => 7500000,
                'repaymentPicture' => '/images/verification/transaction/title-fourteenth-donation/transfer-5.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(5),
                'updated_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 14,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 4,
                'nominal' => 2500000,
                'repaymentPicture' => '/images/verification/transaction/title-fourteenth-donation/transfer-6.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(3),
                'updated_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );

        //donation 17, collected 250.000.000, donate 12
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 5,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-1.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(30),
                'updated_at' => Carbon::now('+7:00')->subDays(30)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 6,
                'nominal' => 2000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-2.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(30),
                'updated_at' => Carbon::now('+7:00')->subDays(30)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 7,
                'nominal' => 3000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-3.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(30),
                'updated_at' => Carbon::now('+7:00')->subDays(30)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 8,
                'nominal' => 4000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-4.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(28),
                'updated_at' => Carbon::now('+7:00')->subDays(28)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 9,
                'nominal' => 7500000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-5.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(25),
                'updated_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 10,
                'nominal' => 2500000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-6.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(24),
                'updated_at' => Carbon::now('+7:00')->subDays(24)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 11,
                'nominal' => 51000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-7.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(20),
                'updated_at' => Carbon::now('+7:00')->subDays(20)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 12,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-8.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(15),
                'updated_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 13,
                'nominal' => 30000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-9.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(12),
                'updated_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 14,
                'nominal' => 20000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-10.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(8),
                'updated_at' => Carbon::now('+7:00')->subDays(8)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 15,
                'nominal' => 70000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-11.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(4),
                'updated_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 17,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 16,
                'nominal' => 50000000,
                'repaymentPicture' => '/images/verification/transaction/title-seventeenth-donation/transfer-12.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(2),
                'updated_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );

        //donation 18, collected 125.000.000, donate 9
        DB::table('transaction')->insert(
            [
                'idDonation' => 18,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 17,
                'nominal' => 10000000,
                'repaymentPicture' => '/images/verification/transaction/title-eighteenth-donation/transfer-1.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(29),
                'updated_at' => Carbon::now('+7:00')->subDays(29)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 18,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 18,
                'nominal' => 10000000,
                'repaymentPicture' => '/images/verification/transaction/title-eighteenth-donation/transfer-2.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(29),
                'updated_at' => Carbon::now('+7:00')->subDays(29)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 18,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 4,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-eighteenth-donation/transfer-3.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(25),
                'updated_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 18,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 5,
                'nominal' => 4000000,
                'repaymentPicture' => '/images/verification/transaction/title-eighteenth-donation/transfer-4.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(22),
                'updated_at' => Carbon::now('+7:00')->subDays(22)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 18,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 6,
                'nominal' => 7500000,
                'repaymentPicture' => '/images/verification/transaction/title-eighteenth-donation/transfer-5.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(12),
                'updated_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 18,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 7,
                'nominal' => 2500000,
                'repaymentPicture' => '/images/verification/transaction/title-eighteenth-donation/transfer-6.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(10),
                'updated_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 18,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 8,
                'nominal' => 51000000,
                'repaymentPicture' => '/images/verification/transaction/title-eighteenth-donation/transfer-7.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(4),
                'updated_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 18,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 9,
                'nominal' => 5000000,
                'repaymentPicture' => '/images/verification/transaction/title-eighteenth-donation/transfer-8.jpg',
                'annonymous_donate' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(2),
                'updated_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );
        DB::table('transaction')->insert(
            [
                'idDonation' => 18,
                'accountNumber' => '209708591042',
                'status' => 1,
                'idParticipant' => 10,
                'nominal' => 30000000,
                'repaymentPicture' => '/images/verification/transaction/title-eighteenth-donation/transfer-9.jpg',
                'annonymous_donate' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(),
                'updated_at' => Carbon::now('+7:00')->subDay()
            ]
        );
    }
}
