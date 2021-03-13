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
        DB::table('update_news')->insert(
            [
                'idPetition' => 1,
                'image' => "images/petition/update_news/1.jpg",
                'title' => "Lorem",
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 1,
                'image' => "images/petition/update_news/2.jpg",
                'title' => "Ipsum",
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('update_news')->insert(
            [
                'idPetition' => 2,
                'image' => "images/petition/update_news/3.jpg",
                'title' => "Lorem",
                'content' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod, voluptatem iusto optio quia atque eveniet numquam. Id optio ipsum, qui quisquam ipsa eius aspernatur culpa enim perferendis pariatur. Ratione at dolorem voluptatem quis et quas architecto repudiandae possimus dicta hic. Earum maxime asperiores accusantium facilis tenetur tempora soluta natus consequuntur?",
                'link' => '',
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
    }
}
