<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // petition 6, news 2
        DB::table('update_news')->insert(
            [
                'idPetition' => 6,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'image' => "/images/petition/update_news/petition-title-six/news-1.jpg",
                'title' => "Petition 6 News 1",
                'created_at' => Carbon::now('+7:00')->subDays(20),
                'updated_at' => Carbon::now('+7:00')->subDays(20),
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 6,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'image' => "/images/petition/update_news/petition-title-six/news-2.jpg",
                'title' => "Petition 6 News 2",
                'created_at' => Carbon::now('+7:00')->subDays(10),
                'updated_at' => Carbon::now('+7:00')->subDays(10),
            ]
        );

        // petition 7, news 1
        DB::table('update_news')->insert(
            [
                'idPetition' => 7,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'image' => "/images/petition/update_news/petition-title-seven/news-1.jpg",
                'title' => "Petition 7 News 1",
                'created_at' => Carbon::now('+7:00')->subDays(10),
                'updated_at' => Carbon::now('+7:00')->subDays(10),
            ]
        );

        // petition 9, news 1
        DB::table('update_news')->insert(
            [
                'idPetition' => 9,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => 'https://vin-albertus.blogspot.com',
                'image' => "/images/petition/update_news/petition-title-nine/news-1.jpg",
                'title' => "Petition 9 News 1",
                'created_at' => Carbon::now('+7:00')->subDays(16),
                'updated_at' => Carbon::now('+7:00')->subDays(16),
            ]
        );

        // petition 12, news 1
        DB::table('update_news')->insert(
            [
                'idPetition' => 12,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => 'https://albertuskevin.github.io',
                'image' => "/images/petition/update_news/petition-title-twelve/news-1.jpg",
                'title' => "Petition 12 News 1",
                'created_at' => Carbon::now('+7:00')->subDays(6),
                'updated_at' => Carbon::now('+7:00')->subDays(6),
            ]
        );

        // petition 14, news 3
        DB::table('update_news')->insert(
            [
                'idPetition' => 14,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => 'https://albertuskevin.github.io',
                'image' => "/images/petition/update_news/petition-title-fourteen/news-1.jpg",
                'title' => "Petition 14 News 1",
                'created_at' => Carbon::now('+7:00')->subDays(16),
                'updated_at' => Carbon::now('+7:00')->subDays(16),
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 14,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'image' => "/images/petition/update_news/petition-title-fourteen/news-2.jpg",
                'title' => "Petition 14 News 2",
                'created_at' => Carbon::now('+7:00')->subDays(8),
                'updated_at' => Carbon::now('+7:00')->subDays(8),
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 14,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => 'https://vin-albertus.blogspot.com',
                'image' => "/images/petition/update_news/petition-title-fourteen/news-3.jpg",
                'title' => "Petition 14 News 3",
                'created_at' => Carbon::now('+7:00')->subDays(2),
                'updated_at' => Carbon::now('+7:00')->subDays(2),
            ]
        );


        // petition 17, news 3
        DB::table('update_news')->insert(
            [
                'idPetition' => 17,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => 'https://vin-albertus.blogspot.com',
                'image' => "/images/petition/update_news/petition-title-seventeen/news-1.jpg",
                'title' => "Petition 17 News 1",
                'created_at' => Carbon::now('+7:00')->subDays(40),
                'updated_at' => Carbon::now('+7:00')->subDays(40),
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 17,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'image' => "/images/petition/update_news/petition-title-seventeen/news-2.jpg",
                'title' => "Petition 17 News 2",
                'created_at' => Carbon::now('+7:00')->subDays(20),
                'updated_at' => Carbon::now('+7:00')->subDays(20),
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 17,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'image' => "/images/petition/update_news/petition-title-seventeen/news-3.jpg",
                'title' => "Petition 17 News 3",
                'created_at' => Carbon::now('+7:00')->subDays(3),
                'updated_at' => Carbon::now('+7:00')->subDays(3),
            ]
        );
        // petition 18, news 4
        DB::table('update_news')->insert(
            [
                'idPetition' => 18,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => 'https://vin-albertus.blogspot.com',
                'image' => "/images/petition/update_news/petition-title-eighteen/news-1.jpg",
                'title' => "Petition 18 News 1",
                'created_at' => Carbon::now('+7:00')->subDays(40),
                'updated_at' => Carbon::now('+7:00')->subDays(40),
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 18,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'image' => "/images/petition/update_news/petition-title-eighteen/news-2.jpg",
                'title' => "Petition 18 News 2",
                'created_at' => Carbon::now('+7:00')->subDays(30),
                'updated_at' => Carbon::now('+7:00')->subDays(30),
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 18,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'image' => "/images/petition/update_news/petition-title-eighteen/news-3.jpg",
                'title' => "Petition 18 News 3",
                'created_at' => Carbon::now('+7:00')->subDays(15),
                'updated_at' => Carbon::now('+7:00')->subDays(15),
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 18,
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => 'https://albertuskevin.github.io',
                'image' => "/images/petition/update_news/petition-title-eighteen/news-4.jpg",
                'title' => "Petition 18 News 4",
                'created_at' => Carbon::now('+7:00')->subDays(8),
                'updated_at' => Carbon::now('+7:00')->subDays(8),
            ]
        );
    }
}
