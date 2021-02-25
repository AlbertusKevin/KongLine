<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('petition')->insert(
            [
                'id' => 1,
                'category' => 1,
                'deadline' => Carbon::create('2021', '04', '01'),
                'idCampaigner' => 2,
                'photo' => 'images/petition/tolak.jpg',
                'purpose' => 'Confirmation invvestor',
                'status' => 1,
                'title' => 'Tolak Biaya Materai Untuk Saham',
                'targetPerson' => 'investor',
                'signedCollected' => 10,
                'signedTarget' => 100
            ]
        );
    }
}
