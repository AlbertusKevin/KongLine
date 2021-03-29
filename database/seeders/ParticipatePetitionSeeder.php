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
                'idParticipant' => 4,
                'comment' => 'Yuk bisa yu demi nilai yang lebih baik :)',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 1,
                'idParticipant' => 5,
                'comment' => 'Semoga lulus ya',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 2,
                'idParticipant' => 5,
                'comment' => 'Yuk Isi Yuk buat beli permen',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 3,
                'idParticipant' => 4,
                'comment' => 'Demi kelulusan yang memuaskan',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 4,
                'idParticipant' => 6,
                'comment' => 'Yu tanda tangan untuk lingkungan kita juga lho..',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 5,
                'idParticipant' => 7,
                'comment' => 'Akhir-akhir ini pendistibusian vaksin belum merata mari kita ajukan kritik dan saran untuk pemerintah',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 8,
                'comment' => 'Demi masa depan bangsa yang terhindar dari generasi tiktod',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 9,
                'idParticipant' => 10,
                'comment' => 'Siapa kita? Prediksi.. Prediksi, Jaya Jaya Jaya!!',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
