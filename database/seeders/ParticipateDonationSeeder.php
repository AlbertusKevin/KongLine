<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ParticipateDonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Donation 5, collected 210.000.000, 10 donate
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 4,
                'comment' => 'Comment From Participant 4',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 5,
                'comment' => 'Comment From Participant 5',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 6,
                'comment' => 'Comment From Participant 6',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 8,
                'comment' => 'Comment From Participant 8',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 10,
                'comment' => 'Comment From Participant 10',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 12,
                'comment' => 'Comment From Participant 12',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 14,
                'comment' => 'Comment From Campaigner 14',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 16,
                'comment' => 'Comment From Campaigner 16',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 17,
                'comment' => 'Comment From Campaigner 17',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 18,
                'comment' => 'Comment From Campaigner 18',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );

        // Donation 6, collected 25.000.000, 6 donate
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 6,
                'idParticipant' => 18,
                'comment' => 'Comment From Campaigner 18',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 6,
                'idParticipant' => 4,
                'comment' => 'Comment From Participant 4',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 6,
                'idParticipant' => 5,
                'comment' => 'Comment From Participant 5',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 6,
                'idParticipant' => 6,
                'comment' => 'Comment From Participant 6',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 6,
                'idParticipant' => 7,
                'comment' => 'Comment From Participant 7',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDay()
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 6,
                'idParticipant' => 8,
                'comment' => 'Comment From Participant 8',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay()
            ]
        );

        //donation 7, collected 5000.000, donate 4
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 7,
                'idParticipant' => 9,
                'comment' => 'Comment From Participant 9',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 7,
                'idParticipant' => 10,
                'comment' => 'Comment From Participant 10',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 7,
                'idParticipant' => 11,
                'comment' => 'Comment From Participant 11',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 7,
                'idParticipant' => 12,
                'comment' => 'Comment From Participant 12',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')
            ]
        );

        //donation 8, collected 500.000, donate 2
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 8,
                'idParticipant' => 13,
                'comment' => 'Comment From Participant 13',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 8,
                'idParticipant' => 14,
                'comment' => 'Comment From Campaigner 14',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')
            ]
        );

        //donation 9, collected 25.000.000, donate 5
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 9,
                'idParticipant' => 15,
                'comment' => 'Comment From Campaigner 15',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(8)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 9,
                'idParticipant' => 16,
                'comment' => 'Comment From Campaigner 16',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 9,
                'idParticipant' => 17,
                'comment' => 'Comment From Campaigner 17',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 9,
                'idParticipant' => 18,
                'comment' => 'Comment From Campaigner 18',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay()
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 9,
                'idParticipant' => 4,
                'comment' => 'Comment From Participant 4',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay()
            ]
        );

        //donation 10, collected 10.000.000, donate 8
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 10,
                'idParticipant' => 5,
                'comment' => 'Comment From Participant 5',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(16)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 10,
                'idParticipant' => 6,
                'comment' => 'Comment From Participant 6',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDay(16)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 10,
                'idParticipant' => 7,
                'comment' => 'Comment From Participant 7',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(15)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 10,
                'idParticipant' => 8,
                'comment' => 'Comment From Participant 8',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(13)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 10,
                'idParticipant' => 9,
                'comment' => 'Comment From Participant 9',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(10)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 10,
                'idParticipant' => 10,
                'comment' => 'Comment From Participant 10',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDay(8)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 10,
                'idParticipant' => 11,
                'comment' => 'Comment From Participant 11',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(7)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 10,
                'idParticipant' => 12,
                'comment' => 'Comment From Participant 12',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDay(6)
            ]
        );

        //donation 11, collected 15.000.000, donate 8
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 11,
                'idParticipant' => 13,
                'comment' => 'Comment From Participant 13',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(11)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 11,
                'idParticipant' => 14,
                'comment' => 'Comment From Campaigner 14',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(10)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 11,
                'idParticipant' => 15,
                'comment' => 'Comment From Campaigner 15',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDay(9)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 11,
                'idParticipant' => 16,
                'comment' => 'Comment From Campaigner 16',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(8)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 11,
                'idParticipant' => 17,
                'comment' => 'Comment From Campaigner 17',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(6)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 11,
                'idParticipant' => 18,
                'comment' => 'Comment From Campaigner 18',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDay(6)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 11,
                'idParticipant' => 4,
                'comment' => 'Comment From Participant 4',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDay(4)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 11,
                'idParticipant' => 5,
                'comment' => 'Comment From Participant 5',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDay(2)
            ]
        );

        //donation 12, collected 10.000.000, donate 5
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 12,
                'idParticipant' => 6,
                'comment' => 'Comment From Participant 6',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(13)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 12,
                'idParticipant' => 7,
                'comment' => 'Comment From Participant 7',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 12,
                'idParticipant' => 8,
                'comment' => 'Comment From Participant 8',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(9)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 12,
                'idParticipant' => 9,
                'comment' => 'Comment From Participant 9',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 12,
                'idParticipant' => 10,
                'comment' => 'Comment From Participant 10',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );

        //donation 13, collected 25.000.000, donate 3
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 13,
                'idParticipant' => 11,
                'comment' => 'Comment From Participant 11',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(9)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 13,
                'idParticipant' => 12,
                'comment' => 'Comment From Participant 12',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 13,
                'idParticipant' => 13,
                'comment' => 'Comment From Participant 13',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );

        //donation 14, collected 20.000.000, donate 6
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 14,
                'idParticipant' => 14,
                'comment' => 'Comment From Campaigner 14',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(26)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 14,
                'idParticipant' => 15,
                'comment' => 'Comment From Campaigner 15',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(22)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 14,
                'idParticipant' => 16,
                'comment' => 'Comment From Campaigner 16',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 14,
                'idParticipant' => 17,
                'comment' => 'Comment From Campaigner 17',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 14,
                'idParticipant' => 18,
                'comment' => 'Comment From Campaigner 18',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 14,
                'idParticipant' => 4,
                'comment' => 'Comment From Participant 4',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );

        //donation 17, collected 250.000.000, donate 12
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 5,
                'comment' => 'Comment From Participant 5',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(30)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 6,
                'comment' => 'Comment From Participant 6',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(30)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 7,
                'comment' => 'Comment From Participant 7',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(30)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 8,
                'comment' => 'Comment From Participant 8',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(28)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 9,
                'comment' => 'Comment From Participant 9',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 10,
                'comment' => 'Comment From Participant 10',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(24)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 11,
                'comment' => 'Comment From Participant 11',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(20)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 12,
                'comment' => 'Comment From Participant 12',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 13,
                'comment' => 'Comment From Participant 13',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 14,
                'comment' => 'Comment From Campaigner 14',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(8)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 15,
                'comment' => 'Comment From Campaigner 15',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 17,
                'idParticipant' => 16,
                'comment' => 'Comment From Campaigner 16',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );

        //donation 18, collected 125.000.000, donate 9
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 18,
                'idParticipant' => 17,
                'comment' => 'Comment From Campaigner 17',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(29)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 18,
                'idParticipant' => 18,
                'comment' => 'Comment From Campaigner 18',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(29)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 18,
                'idParticipant' => 4,
                'comment' => 'Comment From Participant 4',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 18,
                'idParticipant' => 5,
                'comment' => 'Comment From Participant 5',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(22)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 18,
                'idParticipant' => 6,
                'comment' => 'Comment From Participant 6',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 18,
                'idParticipant' => 7,
                'comment' => 'Comment From Participant 7',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 18,
                'idParticipant' => 8,
                'comment' => 'Comment From Participant 8',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(4)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 18,
                'idParticipant' => 9,
                'comment' => 'Comment From Participant 9',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now('+7:00')->subDays(2)
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 18,
                'idParticipant' => 10,
                'comment' => 'Comment From Participant 10',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now('+7:00')->subDay()
            ]
        );
    }
}
