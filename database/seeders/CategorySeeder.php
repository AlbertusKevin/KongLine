<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert(
            [
                'id' => 1,
                'description' => 'Pendidikan'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 2,
                'description' => 'Bencana Alam'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 3,
                'description' => 'Difabel'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 4,
                'description' => 'Infrastruktur Umum'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 5,
                'description' => 'Teknologi'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 6,
                'description' => 'Budaya'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 7,
                'description' => 'Karya Kreatif dan Modal Usaha'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 8,
                'description' => 'Kegiatan Sosial'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 9,
                'description' => 'Kemanusiaan'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 10,
                'description' => 'Lingkungan'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 11,
                'description' => 'Hewan'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 12,
                'description' => 'Panti Asuhan'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 13,
                'description' => 'Rumah Ibadah'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 14,
                'description' => 'Ekonomi'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 15,
                'description' => 'Politik'
            ]
        );
        DB::table('category')->insert(
            [
                'id' => 16,
                'description' => 'Keadilan'
            ]
        );
    }
}
