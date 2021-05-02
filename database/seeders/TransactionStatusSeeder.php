<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_status')->insert(
            [
                'id' => 0,
                'description' => 'waiting'
            ]
        );
        DB::table('transaction_status')->insert(
            [
                'id' => 1,
                'description' => 'accepted'
            ]
        );
        DB::table('transaction_status')->insert(
            [
                'id' => 2,
                'description' => 'rejected'
            ]
        );
    }
}
