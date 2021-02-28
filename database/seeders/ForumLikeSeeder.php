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
                'idParticipant' => 1,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 1,
                'idParticipant' => 2,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 2,
                'idParticipant' => 1,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 2,
                'idParticipant' => 2,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 1,
                'idParticipant' => 3,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 2,
                'idParticipant' => 3,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
