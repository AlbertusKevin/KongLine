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
        // petition 5, participate 5
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 5,
                'idParticipant' => 4,
                'comment' => 'Comment from participant 4)',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 5,
                'idParticipant' => 5,
                'comment' => 'Comment from participant 5)',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 5,
                'idParticipant' => 6,
                'comment' => 'Comment from participant 6)',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 5,
                'idParticipant' => 7,
                'comment' => 'Comment from participant 7)',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 5,
                'idParticipant' => 8,
                'comment' => 'Comment from participant 8)',
                'created_at' => Carbon::now('+7:00')
            ]
        );

        // petition 6, participate 10
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 9,
                'comment' => 'Comment from participant 9',
                'created_at' => Carbon::now('+7:00')->subDays(27)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 10,
                'comment' => 'Comment from participant 10',
                'created_at' => Carbon::now('+7:00')->subDays(27)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 11,
                'comment' => 'Comment from participant 11',
                'created_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 12,
                'comment' => 'Comment from participant 12',
                'created_at' => Carbon::now('+7:00')->subDays(23)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 13,
                'comment' => 'Comment from participant 13',
                'created_at' => Carbon::now('+7:00')->subDays(20)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 14,
                'comment' => 'Comment from campaigner 14',
                'created_at' => Carbon::now('+7:00')->subDays(18)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 15,
                'comment' => 'Comment from campaigner 15',
                'created_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 8,
                'comment' => 'Comment from campaigner 16',
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 17,
                'comment' => 'Comment from campaigner 17',
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 6,
                'idParticipant' => 18,
                'comment' => 'Comment from campaigner 18',
                'created_at' => Carbon::now('+7:00')
            ]
        );

        // petition 7, participate 12
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 4,
                'comment' => 'Comment from participant 4',
                'created_at' => Carbon::now('+7:00')->subDays(27)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 5,
                'comment' => 'Comment from participant 5',
                'created_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 6,
                'comment' => 'Comment from participant 6',
                'created_at' => Carbon::now('+7:00')->subDays(24)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 7,
                'comment' => 'Comment from participant 7',
                'created_at' => Carbon::now('+7:00')->subDays(23)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 8,
                'comment' => 'Comment from participant 8',
                'created_at' => Carbon::now('+7:00')->subDays(20)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 9,
                'comment' => 'Comment from participant 9',
                'created_at' => Carbon::now('+7:00')->subDays(18)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 10,
                'comment' => 'Comment from participant 10',
                'created_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 11,
                'comment' => 'Comment from participant 11',
                'created_at' => Carbon::now('+7:00')->subDays(14)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 12,
                'comment' => 'Comment from participant 12',
                'created_at' => Carbon::now('+7:00')->subDays(14)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 13,
                'comment' => 'Comment from participant 13',
                'created_at' => Carbon::now('+7:00')->subDays(14)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 14,
                'comment' => 'Comment from campaigner 14',
                'created_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 7,
                'idParticipant' => 15,
                'comment' => 'Comment from campaigner 15',
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );

        // petition 8, participate 8
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 8,
                'idParticipant' => 16,
                'comment' => 'Comment from campaigner 16',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 8,
                'idParticipant' => 17,
                'comment' => 'Comment from campaigner 17',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 8,
                'idParticipant' => 18,
                'comment' => 'Comment from campaigner 18',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 8,
                'idParticipant' => 4,
                'comment' => 'Comment from participant 4',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 8,
                'idParticipant' => 5,
                'comment' => 'Comment from participant 5',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 8,
                'idParticipant' => 6,
                'comment' => 'Comment from participant 6',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 8,
                'idParticipant' => 7,
                'comment' => 'Comment from participant 7',
                'created_at' => Carbon::now('+7:00')
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 8,
                'idParticipant' => 8,
                'comment' => 'Comment from participant 8',
                'created_at' => Carbon::now('+7:00')
            ]
        );

        // petition 9, participate 8
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 9,
                'idParticipant' => 9,
                'comment' => 'Comment from participant 9',
                'created_at' => Carbon::now('+7:00')->subDays(40)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 9,
                'idParticipant' => 10,
                'comment' => 'Comment from participant 10',
                'created_at' => Carbon::now('+7:00')->subDays(35)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 9,
                'idParticipant' => 11,
                'comment' => 'Comment from participant 11',
                'created_at' => Carbon::now('+7:00')->subDays(30)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 9,
                'idParticipant' => 12,
                'comment' => 'Comment from participant 12',
                'created_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 9,
                'idParticipant' => 13,
                'comment' => 'Comment from participant 13',
                'created_at' => Carbon::now('+7:00')->subDays(20)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 9,
                'idParticipant' => 14,
                'comment' => 'Comment from campaigner 14',
                'created_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 9,
                'idParticipant' => 15,
                'comment' => 'Comment from campaigner 15',
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 9,
                'idParticipant' => 16,
                'comment' => 'Comment from campaigner 16',
                'created_at' => Carbon::now('+7:00')->subDays(6)
            ]
        );

        // petition 10, participate 14
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 17,
                'comment' => 'Comment from campaigner 17',
                'created_at' => Carbon::now('+7:00')->subDays(32)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 18,
                'comment' => 'Comment from campaigner 18',
                'created_at' => Carbon::now('+7:00')->subDays(32)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 4,
                'comment' => 'Comment from participant 4',
                'created_at' => Carbon::now('+7:00')->subDays(32)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 5,
                'comment' => 'Comment from participant 5',
                'created_at' => Carbon::now('+7:00')->subDays(32)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 6,
                'comment' => 'Comment from participant 6',
                'created_at' => Carbon::now('+7:00')->subDays(28)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 7,
                'comment' => 'Comment from participant 7',
                'created_at' => Carbon::now('+7:00')->subDays(28)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 8,
                'comment' => 'Comment from participant 8',
                'created_at' => Carbon::now('+7:00')->subDays(28)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 9,
                'comment' => 'Comment from participant 9',
                'created_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 10,
                'comment' => 'Comment from participant 10',
                'created_at' => Carbon::now('+7:00')->subDays(23)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 11,
                'comment' => 'Comment from participant 11',
                'created_at' => Carbon::now('+7:00')->subDays(20)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 12,
                'comment' => 'Comment from participant 12',
                'created_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 13,
                'comment' => 'Comment from participant 13',
                'created_at' => Carbon::now('+7:00')->subDays(13)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 14,
                'comment' => 'Comment from campaigner 14',
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 10,
                'idParticipant' => 15,
                'comment' => 'Comment from campaigner 15',
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );

        // petition 11, participate 7
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 11,
                'idParticipant' => 16,
                'comment' => 'Comment from campaigner 16',
                'created_at' => Carbon::now('+7:00')->subDays(18)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 11,
                'idParticipant' => 17,
                'comment' => 'Comment from campaigner 17',
                'created_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 11,
                'idParticipant' => 18,
                'comment' => 'Comment from campaigner 18',
                'created_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 11,
                'idParticipant' => 4,
                'comment' => 'Comment from participant 4',
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 11,
                'idParticipant' => 5,
                'comment' => 'Comment from participant 5',
                'created_at' => Carbon::now('+7:00')->subDays(8)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 11,
                'idParticipant' => 6,
                'comment' => 'Comment from participant 6',
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 11,
                'idParticipant' => 7,
                'comment' => 'Comment from participant 7',
                'created_at' => Carbon::now('+7:00')->subDays(3)
            ]
        );

        // petition 12, participate 6
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 12,
                'idParticipant' => 8,
                'comment' => 'Comment from participant 8',
                'created_at' => Carbon::now('+7:00')->subDays(21)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 12,
                'idParticipant' => 9,
                'comment' => 'Comment from participant 9',
                'created_at' => Carbon::now('+7:00')->subDays(19)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 12,
                'idParticipant' => 10,
                'comment' => 'Comment from participant 10',
                'created_at' => Carbon::now('+7:00')->subDays(9)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 12,
                'idParticipant' => 7,
                'comment' => 'Comment from participant 7',
                'created_at' => Carbon::now('+7:00')->subDays(9)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 12,
                'idParticipant' => 11,
                'comment' => 'Comment from participant 11',
                'created_at' => Carbon::now('+7:00')->subDays(7)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 12,
                'idParticipant' => 12,
                'comment' => 'Comment from participant 12',
                'created_at' => Carbon::now('+7:00')->subDays(5)
            ]
        );

        // petition 13, participate 2
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 13,
                'idParticipant' => 13,
                'comment' => 'Comment from participant 13',
                'created_at' => Carbon::now('+7:00')->subDays(21)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 13,
                'idParticipant' => 14,
                'comment' => 'Comment from campaigner 14',
                'created_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );

        // petition 14, participate 5
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 14,
                'idParticipant' => 15,
                'comment' => 'Comment from campaigner 15',
                'created_at' => Carbon::now('+7:00')->subDays(21)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 14,
                'idParticipant' => 16,
                'comment' => 'Comment from campaigner 16',
                'created_at' => Carbon::now('+7:00')->subDays(18)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 14,
                'idParticipant' => 17,
                'comment' => 'Comment from campaigner 17',
                'created_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 14,
                'idParticipant' => 18,
                'comment' => 'Comment from campaigner 18',
                'created_at' => Carbon::now('+7:00')->subDays(12)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 14,
                'idParticipant' => 4,
                'comment' => 'Comment from participant 4',
                'created_at' => Carbon::now('+7:00')->subDays(8)
            ]
        );

        // petition 17, participate 10
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 5,
                'comment' => 'Comment from participant 5',
                'created_at' => Carbon::now('+7:00')->subDays(54)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 6,
                'comment' => 'Comment from participant 6',
                'created_at' => Carbon::now('+7:00')->subDays(50)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 7,
                'comment' => 'Comment from participant 7',
                'created_at' => Carbon::now('+7:00')->subDays(42)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 8,
                'comment' => 'Comment from participant 8',
                'created_at' => Carbon::now('+7:00')->subDays(32)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 9,
                'comment' => 'Comment from participant 9',
                'created_at' => Carbon::now('+7:00')->subDays(28)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 10,
                'comment' => 'Comment from participant 10',
                'created_at' => Carbon::now('+7:00')->subDays(20)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 11,
                'comment' => 'Comment from participant 11',
                'created_at' => Carbon::now('+7:00')->subDays(17)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 12,
                'comment' => 'Comment from participant 12',
                'created_at' => Carbon::now('+7:00')->subDays(15)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 13,
                'comment' => 'Comment from participant 13',
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 17,
                'idParticipant' => 14,
                'comment' => 'Comment from campaigner 14',
                'created_at' => Carbon::now('+7:00')->subDays(10)
            ]
        );

        // petition 18, participate 9
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 18,
                'idParticipant' => 15,
                'comment' => 'Comment from campaigner 15',
                'created_at' => Carbon::now('+7:00')->subDays(40)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 18,
                'idParticipant' => 16,
                'comment' => 'Comment from campaigner 16',
                'created_at' => Carbon::now('+7:00')->subDays(32)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 18,
                'idParticipant' => 17,
                'comment' => 'Comment from campaigner 17',
                'created_at' => Carbon::now('+7:00')->subDays(30)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 18,
                'idParticipant' => 18,
                'comment' => 'Comment from campaigner 18',
                'created_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 18,
                'idParticipant' => 4,
                'comment' => 'Comment from participant 4',
                'created_at' => Carbon::now('+7:00')->subDays(29)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 18,
                'idParticipant' => 5,
                'comment' => 'Comment from participant 5',
                'created_at' => Carbon::now('+7:00')->subDays(28)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 18,
                'idParticipant' => 6,
                'comment' => 'Comment from participant 6',
                'created_at' => Carbon::now('+7:00')->subDays(28)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 18,
                'idParticipant' => 7,
                'comment' => 'Comment from participant 7',
                'created_at' => Carbon::now('+7:00')->subDays(25)
            ]
        );
        DB::table('participate_petition')->insert(
            [
                'idPetition' => 18,
                'idParticipant' => 8,
                'comment' => 'Comment from participant 8',
                'created_at' => Carbon::now('+7:00')->subDays(21)
            ]
        );
    }
}
