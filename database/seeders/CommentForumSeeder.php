<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment_forum')->insert(
            [
                'id' => 1,
                'idForum' => 1,
                'idParticipant' => 2,
                'content' => 'Get Well Soon',
                'updated_at' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('comment_forum')->insert(
            [
                'id' => 2,
                'idForum' => 2,
                'idParticipant' => 2,
                'content' => 'You Can Do It',
                'updated_at' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
