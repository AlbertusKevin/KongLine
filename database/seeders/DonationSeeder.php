<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('donation')->insert(
            [
                'category' => 1,
                'deadline' => new Carbon('first day of March 2021'),
                'idCampaigner' => 2,
                'photo' => 'images/photo1',
                'purpose' => 'Cancer',
                'status' => 1,
                'title' => 'Help Cancer',
                'assistedSubject' => 'Cancer',
                'donationCollected' => 7000000,
                'donationTarget' => 10000000,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
