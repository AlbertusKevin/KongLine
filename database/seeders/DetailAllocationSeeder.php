<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detail_allocation')->insert(
            [
                'id' => 1,
                'idDonation' => 1,
                'nominal' => 200000,
                'description' => 'Calm'
            ]
        );
        DB::table('detail_allocation')->insert(
            [
                'id' => 2,
                'idDonation' => 1,
                'nominal' => 100000,
                'description' => 'GBU'
            ]
        );
    }
}