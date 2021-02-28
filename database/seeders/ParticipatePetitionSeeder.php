<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ParticipatePetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 1,
                'idParticipant' => 3,
                'comment' => 'Help me from Cancer',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
