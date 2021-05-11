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
                'idForum' => 1,
                'idParticipant' => 14,
                'content' => 'Coba ke halaman detail dari event yang bersangkutan. Pada bagian pesan, aku melihat ada link yang bisa di klik.',
                'updated_at' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('comment_forum')->insert(
            [
                'idForum' => 1,
                'idParticipant' => 15,
                'content' => 'You can ask directly to admin using chat feature. They are fast respon.',
                'updated_at' => Carbon::now('+7:00'),
                'created_at' => Carbon::now('+7:00'),
            ]
        );

        DB::table('comment_forum')->insert(
            [
                'idForum' => 3,
                'idParticipant' => 4,
                'content' => 'Good question. Same problem with me. Can anyone help?',
                'updated_at' => Carbon::now('+7:00'),
                'created_at' => Carbon::now('+7:00')
            ]
        );
    }
}
