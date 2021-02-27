<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('petition')->insert(
            [
                'category' => 1,
                'deadline' => Carbon::create('2021', '04', '01'),
                'idCampaigner' => 4,
                'photo' => 'images/petition/tolak.jpg',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 1,
                'title' => 'Tolak Biaya Materai Untuk Saham',
                'targetPerson' => 'investor',
                'signedCollected' => 10,
                'signedTarget' => 100,
                'created_at' => Carbon::now()->format('Y-m-d')
            ]
        );
        DB::table('petition')->insert(
            [
                'category' => 1,
                'deadline' => Carbon::create('2021', '04', '01'),
                'idCampaigner' => 4,
                'photo' => 'images/petition/petition2.jpg',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 1,
                'title' => 'petisi ke 2',
                'targetPerson' => 'investor',
                'signedCollected' => 10000,
                'signedTarget' => 1000000,
                'created_at' => Carbon::create('2021', '03', '23'),
            ]
        );
    }
}
