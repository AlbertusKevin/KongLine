<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ForumLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forum_like')->insert(
            [
                'idForum' => 1,
                'idParticipant' => 5,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 1,
                'idParticipant' => 6,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 2,
                'idParticipant' => 7,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 3,
                'idParticipant' => 10,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 4,
                'idParticipant' => 4,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 4,
                'idParticipant' => 6,
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 4,
                'idParticipant' => 12,
                'created_at' => Carbon::now('+7:00')
            ]
        );
    }
}
