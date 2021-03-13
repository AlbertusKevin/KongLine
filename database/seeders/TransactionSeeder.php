<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction')->insert(
            [
                'idDonation' => 1,
                'idParticipant' => 1,
                'accountNumber' => '209708591099',
                'bank' => 'BCA',
                'nominal' => 10000,
                'repaymentPicture' => 'images/buktitrf.jpg',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
