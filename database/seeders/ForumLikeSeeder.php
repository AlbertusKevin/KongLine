<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'idParticipant' => 1
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 1,
                'idParticipant' => 2
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 2,
                'idParticipant' => 1
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 2,
                'idParticipant' => 2
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 1,
                'idParticipant' => 3
            ]
        );
        DB::table('forum_like')->insert(
            [
                'idForum' => 2,
                'idParticipant' => 3
            ]
        );
    }
}
