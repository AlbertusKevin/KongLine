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
            StatusUserSeeder::class,
            UserSeeder::class,
            ForumSeeder::class,
            CommentForumSeeder::class,
            EventStatusSeeder::class,
            DonationSeeder::class,
            PetitionSeeder::class,
            DetailAllocationSeeder::class,
            ForumLikeSeeder::class,
            ParticipateDonationSeeder::class,
            ParticipatePetitionSeeder::class,
            TransactionSeeder::class,
            UpdateNewsSeeder::class,
        ]);
    }
}
