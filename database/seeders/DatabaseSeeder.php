<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TransactionStatusSeeder::class,
            StatusUserSeeder::class,
            EventStatusSeeder::class,
            CategorySeeder::class,
            BankSeeder::class,
            UserSeeder::class,

            DonationSeeder::class,
            // DetailAllocationSeeder::class,
            // ParticipateDonationSeeder::class,
            // TransactionSeeder::class,

            PetitionSeeder::class,
            // ParticipatePetitionSeeder::class,
            // UpdateNewsSeeder::class,

            // ForumSeeder::class,
            // CommentForumSeeder::class,
            // ForumLikeSeeder::class,
        ]);
    }
}
