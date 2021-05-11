<?php

namespace Database\Seeders;

use App\Domain\Event\Entity\UpdateNews;
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
            CategorySeeder::class,
            TransactionStatusSeeder::class,
            BankSeeder::class,
            StatusUserSeeder::class,
            UserSeeder::class,
            EventStatusSeeder::class,
          
            DonationSeeder::class,
            DetailAllocationSeeder::class,
            ParticipateDonationSeeder::class,
            TransactionSeeder::class,

            PetitionSeeder::class,
            ParticipatePetitionSeeder::class,
            UpdateNewsSeeder::class,

            ForumSeeder::class,
            CommentForumSeeder::class,
            ForumLikeSeeder::class,
        ]);
    }
}
