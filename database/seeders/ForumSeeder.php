<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forum')->insert(
            [
                'id' => 1,
                'idParticipant' => 2,
                'content' => 'Help the Cancer',
                'title' => 'Cancer'
            ]
        );
        DB::table('forum')->insert(
            [
                'id' => 2,
                'idParticipant' => 2,
                'content' => 'Help the Tumor',
                'title' => 'Tumor'
            ]
        );
        DB::table('forum')->insert(
            [
                'id' => 3,
                'idParticipant' => 2,
                'content' => 'Help from earthquake',
                'title' => 'earthquake'
            ]
        );
        DB::table('forum')->insert(
            [
                'id' => 4,
                'idParticipant' => 2,
                'content' => 'Help from tsunami',
                'title' => 'Tsunami'
            ]
        );
    }
}
