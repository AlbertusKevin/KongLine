<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank')->insert(
            [
                'id' => 1,
                'bank' => 'BCA'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 2,
                'bank' => 'BRI'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 3,
                'bank' => 'BNI'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 4,
                'bank' => 'Mandiri'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 5,
                'bank' => 'BTPN'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 6,
                'bank' => 'NISP'
            ]
        );
    }
}
