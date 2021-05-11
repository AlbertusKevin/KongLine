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
                'idParticipant' => 16,
                'content' => 'I Have an event, but got rejected. I want to fix the detail about event and resubmit. How can it be done?',
                'title' => 'How to edit my event?',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('forum')->insert(
            [
                'idParticipant' => 15,
                'content' => "I don't understand how to fill the detail allocation field when wanna to create donation. Can anyone help me?",
                'title' => 'Detail Allocation',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('forum')->insert(
            [
                'idParticipant' => 6,
                'content' => 'If i participate a donation and i just finish to fill the form, how long the time needed to upload the transaction?',
                'title' => 'Donate',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('forum')->insert(
            [
                'idParticipant' => 10,
                'content' => 'What would be happen if an event of petition reach the deadline date, but the sign is not reach the target?',
                'title' => 'Deadline An Event',
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00')
            ]
        );
    }
}
