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
        DB::table('bank')->insert(
            [
                'id' => 7,
                'bank' => 'BUKOPIN'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 8,
                'bank' => 'Arta Graha'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 9,
                'bank' => 'Panin'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 10,
                'bank' => 'Diamond'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 11,
                'bank' => 'Citibank'
            ]
        );
        DB::table('bank')->insert(
            [
                'id' => 12,
                'bank' => 'Maybank'
            ]
        );
    }
}
