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

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~ Status: To Be Confirmed ~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================

        // petition 1, ID = 1, status = 0, campaigner = 17, category = 3
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title One',
                'photo' => '/images/petition/events/petition-1.png',
                'status' => 0,
                'category' => 3,
                'idCampaigner' => 17,
                'signedTarget' => 10000,
                'signedCollected' => 0,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 1',
            ]
        );

        // petition 2, ID = 2, status = 0, campaigner = 18, category = 3
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Two',
                'photo' => '/images/petition/events/petition-2.jpg',
                'status' => 0,
                'category' => 3,
                'idCampaigner' => 18,
                'signedTarget' => 20000,
                'signedCollected' => 0,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 2',
            ]
        );

        // petition 3, ID = 3, status = 0, campaigner = 15, category = 3
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Three',
                'photo' => '/images/petition/events/petition-3.png',
                'status' => 0,
                'category' => 3,
                'idCampaigner' => 15,
                'signedTarget' => 100000,
                'signedCollected' => 0,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 3',
            ]
        );

        // petition 4, ID = 4, status = 0, campaigner = 14, category = 1
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Four',
                'photo' => '/images/petition/events/petition-4.png',
                'status' => 0,
                'category' => 1,
                'idCampaigner' => 14,
                'signedTarget' => 50000,
                'signedCollected' => 0,
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 4',
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~~ Status: Active ~~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // petition 5, ID = 5, status = 1, campaigner = 16, category = 1
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Five',
                'photo' => '/images/petition/events/petition-5.jpg',
                'status' => 1,
                'category' => 1,
                'idCampaigner' => 16,
                'signedTarget' => 60000,
                'signedCollected' => 5,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(4 * 7)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 5',
            ]
        );

        // petition 6, ID = 6, status = 1, campaigner = 16, category = 5
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Six',
                'photo' => '/images/petition/events/petition-6.jpeg',
                'status' => 1,
                'category' => 5,
                'idCampaigner' => 16,
                'signedTarget' => 25000,
                'signedCollected' => 10,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(2)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(26),
                'updated_at' => Carbon::now('+7:00')->subDays(26),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 6',
            ]
        );

        // petition 7, ID = 7, status = 1, campaigner = 15, category = 5
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Seven',
                'photo' => '/images/petition/events/petition-7.jpeg',
                'status' => 1,
                'category' => 5,
                'idCampaigner' => 15,
                'signedTarget' => 10,
                'signedCollected' => 12,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDay()->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(27),
                'updated_at' => Carbon::now('+7:00')->subDays(27),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 7',
            ]
        );

        // petition 8, ID = 8, status = 1, campaigner = 17, category = 7
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Eight',
                'photo' => '/images/petition/events/petition-8.jpg',
                'status' => 1,
                'category' => 7,
                'idCampaigner' => 17,
                'signedTarget' => 25000,
                'signedCollected' => 8,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(4 * 7)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 8',
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~ Status: Finished ~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // petition 9, ID = 9, status = 2, campaigner = 18, category = 7
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Nine',
                'photo' => '/images/petition/events/petition-9.jpg',
                'status' => 2,
                'category' => 7,
                'idCampaigner' => 18,
                'signedTarget' => 10,
                'signedCollected' => 8,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->subDays(10)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(66),
                'updated_at' => Carbon::now('+7:00')->subDays(66),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 9',
            ]
        );

        // petition 10, ID = 10, status = 2, campaigner = 14, category = 9
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Ten',
                'photo' => '/images/petition/events/petition-10.png',
                'status' => 2,
                'category' => 9,
                'idCampaigner' => 14,
                'signedTarget' => 10,
                'signedCollected' => 14,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->subDays(3)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(38),
                'updated_at' => Carbon::now('+7:00')->subDays(38),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 10',
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~~ Status: Closed ~~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // petition 11, ID = 11, status = 3, campaigner = 14, category = 9
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Eleven',
                'photo' => '/images/petition/events/petition-11.jpg',
                'status' => 3,
                'category' => 9,
                'idCampaigner' => 14,
                'signedTarget' => 12000,
                'signedCollected' => 7,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(10)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(18),
                'updated_at' => Carbon::now('+7:00')->subDays(18),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 11',
            ]
        );

        // petition 12, ID = 12, status = 3, campaigner = 15, category = 11
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Twelve',
                'photo' => '/images/petition/events/petition-12.jpg',
                'status' => 3,
                'category' => 11,
                'idCampaigner' => 15,
                'signedTarget' => 15000,
                'signedCollected' => 6,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(10)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(18),
                'updated_at' => Carbon::now('+7:00')->subDays(18),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 12',
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~ Status: Canceled ~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // petition 13, ID = 13, status = 4, campaigner = 18, category = 11
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Thirteen',
                'photo' => '/images/petition/events/petition-13.jpg',
                'status' => 4,
                'category' => 11,
                'idCampaigner' => 18,
                'signedTarget' => 20000,
                'signedCollected' => 2,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(8)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(20),
                'updated_at' => Carbon::now('+7:00')->subDays(20),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 13',
            ]
        );

        // petition 14, ID = 14, status = 4, campaigner = 17, category = 13
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Fourteen',
                'photo' => '/images/petition/events/petition-14.jpg',
                'status' => 4,
                'category' => 13,
                'idCampaigner' => 17,
                'signedTarget' => 7500,
                'signedCollected' => 5,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(8)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(20),
                'updated_at' => Carbon::now('+7:00')->subDays(20),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 14',
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~ Status: Rejected ~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // petition 15, ID = 15, status = 5, campaigner = 16, category = 13
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Fifteen',
                'photo' => '/images/petition/events/petition-15.jpg',
                'status' => 5,
                'category' => 13,
                'idCampaigner' => 16,
                'signedTarget' => 100000,
                'signedCollected' => 0,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(4 * 7)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 15',
            ]
        );

        // petition 16, ID = 16, status = 5, campaigner = 14, category = 15
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Sixteen',
                'photo' => '/images/petition/events/petition-16.jpg',
                'status' => 5,
                'category' => 15,
                'idCampaigner' => 14,
                'signedTarget' => 250000,
                'signedCollected' => 0,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(4 * 7)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 16',
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~ Status: Proceeded ~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // petition 17, ID = 17, status = 6, campaigner = 15, category = 15
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Seventeen',
                'photo' => '/images/petition/events/petition-17.jpg',
                'status' => 6,
                'category' => 15,
                'idCampaigner' => 15,
                'signedTarget' => 5,
                'signedCollected' => 5,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->subDays(60 - 28)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(60),
                'updated_at' => Carbon::now('+7:00')->subDays(60),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 17',
            ]
        );

        // petition 18, ID = 18, status = 6, campaigner = 14, category = 3
        DB::table('petition')->insert(
            [
                'title' => 'Petition Title Eighteen',
                'photo' => '/images/petition/events/petition-18.jpg',
                'status' => 6,
                'category' => 3,
                'idCampaigner' => 14,
                'signedTarget' => 8,
                'signedCollected' => 9,
                'stack' => 1,
                'deadline' => Carbon::now('+07:00')->subDays(100 - 8 * 7)->format('Y-m-d'),
                'created_at' => Carbon::now('+7:00')->subDays(100),
                'updated_at' => Carbon::now('+7:00')->subDays(100),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'targetPerson' => 'Target Petisi 18',
            ]
        );
    }
}
