<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_status')->insert(
            [
                'id' => 0,
                'description' => 'not confirmed'
            ]
        );
        DB::table('event_status')->insert(
            [
                'id' => 1,
                'description' => 'active'
            ]
        );
        DB::table('event_status')->insert(
            [
                'id' => 2,
                'description' => 'finished'
            ]
        );
        DB::table('event_status')->insert(
            [
                'id' => 3,
                'description' => 'closed'
            ]
        );
        DB::table('event_status')->insert(
            [
                'id' => 4,
                'description' => 'canceled'
            ]
        );
    }
}
