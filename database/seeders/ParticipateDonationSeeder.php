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
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 1,
                'idParticipant' => 4,
                'comment' => 'Semoga Terkumpul ya',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 2,
                'idParticipant' => 5,
                'comment' => 'Semoga engga dicoret dari KK ya..',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 1,
                'idParticipant' => 6,
                'comment' => '',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 3,
                'idParticipant' => 7,
                'comment' => 'Semoga Sukses Selalu Pak',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 4,
                'idParticipant' => 8,
                'comment' => 'Lancar Terus ya sayang kuliah nya',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 5,
                'idParticipant' => 11,
                'comment' => 'Jangan main TikTok terus ya bu.. Masak bu buat suami',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 7,
                'idParticipant' => 5,
                'comment' => 'Lekas Sembuh ya',
                'annonymous_comment' => 0,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_donation')->insert(
            [
                'idDonation' => 7,
                'idParticipant' => 6,
                'comment' => 'Cepet Sembuh ya bro',
                'annonymous_comment' => 1,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
