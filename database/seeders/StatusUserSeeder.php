<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_user')->insert(
            [
                'id' => 0,
                'description' => 'deleted'
            ]
        );
        DB::table('status_user')->insert(
            [
                'id' => 1,
                'description' => 'active'
            ]
        );
        DB::table('status_user')->insert(
            [
                'id' => 2,
                'description' => 'blocked'
            ]
        );
        DB::table('status_user')->insert(
            [
                'id' => 3,
                'description' => 'waiting'
            ]
        );
    }
}
