<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                'title' => 'Cancer',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('forum')->insert(
            [
                'id' => 2,
                'idParticipant' => 2,
                'content' => 'Help the Tumor',
                'title' => 'Tumor',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('forum')->insert(
            [
                'id' => 3,
                'idParticipant' => 2,
                'content' => 'Help from earthquake',
                'title' => 'earthquake',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('forum')->insert(
            [
                'id' => 4,
                'idParticipant' => 2,
                'content' => 'Help from tsunami',
                'title' => 'Tsunami',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
