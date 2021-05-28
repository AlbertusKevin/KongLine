<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~ Status: To Be Confirm ~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // donation 1, ID = 1, status = 0, campaigner = 14, category = 1
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-1.jpg',
                'title' => 'Title First Donation',
                'idCampaigner' => 14,
                'category' => 1,
                'status' => 0,
                'duration_event' => 4,
                'deadline' => Carbon::now('+07:00')->addDays(4 * 7)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 0,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 0,
                'donationTarget' => 150000000,
                'bank' => 1,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // donation 2, ID = 2, status = 0, campaigner = 15, category = 1
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-2.jpg',
                'title' => 'Title Second Donation',
                'idCampaigner' => 15,
                'category' => 1,
                'status' => 0,
                'duration_event' => 2,
                'deadline' => Carbon::now('+07:00')->addDays(2 * 7)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 0,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 0,
                'donationTarget' => 50000000,
                'bank' => 1,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // donation 3, ID = 3, status = 0, campaigner = 16, category = 1
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-3.jpg',
                'title' => 'Title Third Donation',
                'idCampaigner' => 16,
                'category' => 1,
                'status' => 0,
                'duration_event' => 2,
                'deadline' => Carbon::now('+07:00')->addDays(14)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 0,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 0,
                'donationTarget' => 80000000,
                'bank' => 2,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // donation 4, ID = 4, status = 0, campaigner = 17, category = 2
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-4.jpg',
                'title' => 'Title Fourth Donation',
                'idCampaigner' => 17,
                'category' => 2,
                'status' => 0,
                'duration_event' => 2,
                'deadline' => Carbon::now('+07:00')->addDays(14)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 0,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 0,
                'donationTarget' => 70000000,
                'bank' => 2,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~~ Status: Active ~~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // donation 5, ID = 5, status = 1, campaigner = 14, category = 2
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-5.jpg',
                'title' => 'Title Fifth Donation',
                'idCampaigner' => 14,
                'category' => 2,
                'status' => 1,
                'duration_event' => 1,
                'deadline' => Carbon::now('+07:00')->addDay()->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 10,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 210000000,
                'donationTarget' => 200000000,
                'bank' => 3,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(6),
                'updated_at' => Carbon::now('+7:00')->subDays(6),
            ]
        );

        // donation 6, ID = 6, status = 1, campaigner = 18, category = 4
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-6.jpg',
                'title' => 'Title Sixth Donation',
                'idCampaigner' => 18,
                'category' => 4,
                'status' => 1,
                'duration_event' => 2,
                'deadline' => Carbon::now('+7:00')->addDays(11)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 6,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 25000000,
                'donationTarget' => 100000000,
                'bank' => 4,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(3),
                'updated_at' => Carbon::now('+7:00')->subDays(3),
            ]
        );

        // donation 7, ID = 7, status = 1, campaigner = 15, category = 4
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-7.jpeg',
                'title' => 'Title Seventh Donation',
                'idCampaigner' => 15,
                'category' => 4,
                'status' => 1,
                'duration_event' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(7)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 4,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 5000000,
                'donationTarget' => 20000000,
                'bank' => 5,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // donation 8, ID = 8, status = 1, campaigner = 16, category = 6
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-8.png',
                'title' => 'Title Eighth Donation',
                'idCampaigner' => 16,
                'category' => 6,
                'status' => 1,
                'duration_event' => 1,
                'deadline' => Carbon::now('+07:00')->addDays(7)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 2,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 500000,
                'donationTarget' => 10000000,
                'bank' => 6,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~ Status: Finished ~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // donation 9, ID = 9, status = 2, campaigner = 17, category = 6
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-9.jpg',
                'title' => 'Title Ninth Donation',
                'idCampaigner' => 17,
                'category' => 6,
                'status' => 2,
                'duration_event' => 1,
                'deadline' => Carbon::now('+7:00')->subDay()->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 5,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 25000000,
                'donationTarget' => 10000000,
                'bank' => 7,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(8),
                'updated_at' => Carbon::now('+7:00')->subDays(8),
            ]
        );

        // donation 10, ID = 10, status = 2, campaigner = 18, category = 8
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-10.jpg',
                'title' => 'Title Tenth Donation',
                'idCampaigner' => 18,
                'category' => 8,
                'status' => 2,
                'duration_event' => 2,
                'deadline' => Carbon::now('+7:00')->subdays(2)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 8,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 10000000,
                'donationTarget' => 15000000,
                'bank' => 8,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(16),
                'updated_at' => Carbon::now('+7:00')->subDays(16),
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~~ Status: Closed ~~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // donation 11, ID = 11, status = 3, campaigner = 14, category = 8
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-11.jpg',
                'title' => 'Title Eleventh Donation',
                'idCampaigner' => 14,
                'category' => 8,
                'status' => 3,
                'duration_event' => 2,
                'deadline' => Carbon::now('+7:00')->addDays(3)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 8,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 15000000,
                'donationTarget' => 20000000,
                'bank' => 7,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(11),
                'updated_at' => Carbon::now('+7:00')->subDays(11),
            ]
        );

        // donation 12, ID = 12, status = 3, campaigner = 15, category = 10
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-12.jpg',
                'title' => 'Title Twelfth Donation',
                'idCampaigner' => 15,
                'category' => 10,
                'status' => 3,
                'duration_event' => 2,
                'deadline' => Carbon::now('+7:00')->addDay()->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 5,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 10000000,
                'donationTarget' => 50000000,
                'bank' => 9,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(13),
                'updated_at' => Carbon::now('+7:00')->subDays(13),
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~ Status: Canceled ~~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // donation 13, ID = 13, status = 4, campaigner = 16, category = 10
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-13.jpg',
                'title' => 'Title Thirteenth Donation',
                'idCampaigner' => 16,
                'category' => 10,
                'status' => 4,
                'duration_event' => 2,
                'deadline' => Carbon::now('+7:00')->addDays(5)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 3,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 25000000,
                'donationTarget' => 100000000,
                'bank' => 10,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(9),
                'updated_at' => Carbon::now('+7:00')->subDays(9),
            ]
        );

        // donation 14, ID = 14, status = 4, campaigner = 14, category = 12
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-14.jpg',
                'title' => 'Title Fourteenth Donation',
                'idCampaigner' => 14,
                'category' => 12,
                'status' => 4,
                'duration_event' => 4,
                'deadline' => Carbon::now('+7:00')->addDay()->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 6,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 20000000,
                'donationTarget' => 25000000,
                'bank' => 11,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(27),
                'updated_at' => Carbon::now('+7:00')->subDays(27),
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~~ Status: Rejected ~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // donation 15, ID = 15, status = 5, campaigner = 18, category = 14
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-15.jpg',
                'title' => 'Title Fifteenth Donation',
                'idCampaigner' => 18,
                'category' => 14,
                'status' => 5,
                'duration_event' => 2,
                'deadline' => Carbon::now('+7:00')->addDays(14)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 0,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 0,
                'donationTarget' => 90000000,
                'bank' => 12,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        // donation 16, ID = 16, status = 5, campaigner = 14, category = 16
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-16.jpg',
                'title' => 'Title Sixteenth Donation',
                'idCampaigner' => 14,
                'category' => 16,
                'status' => 5,
                'duration_event' => 2,
                'deadline' => Carbon::now('+7:00')->addDays(14)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 0,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 0,
                'donationTarget' => 150000000,
                'bank' => 12,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00'),
                'updated_at' => Carbon::now('+7:00'),
            ]
        );

        //? ================================================================
        //! ~~~~~~~~~~~~~~~~~~~~~ Status: Proceeded ~~~~~~~~~~~~~~~~~~~~~~~~
        //? ================================================================
        // donation 17, ID = 17, status = 6, campaigner = 17, category = 16
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-17.jpg',
                'title' => 'Title Seventeenth Donation',
                'idCampaigner' => 17,
                'category' => 16,
                'status' => 6,
                'duration_event' => 4,
                'deadline' => Carbon::now('+7:00')->subDays(7)->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 12,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 250000000,
                'donationTarget' => 100000000,
                'bank' => 8,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(35),
                'updated_at' => Carbon::now('+7:00')->subDays(35),
            ]
        );

        // donation 18, ID = 18, status = 6, campaigner = 14, category = 16
        DB::table('donation')->insert(
            [
                'photo' => '\images\donation\donation-18.jpg',
                'title' => 'Title Eighteenth Donation',
                'idCampaigner' => 14,
                'category' => 16,
                'status' => 6,
                'duration_event' => 4,
                'deadline' => Carbon::now('+7:00')->subDay()->format('Y-m-d'),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam? \n Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'totalDonatur' => 9,
                'assistedSubject' => 'Masyarakat Umum',
                'donationCollected' => 125000000,
                'donationTarget' => 50000000,
                'bank' => 11,
                'accountNumber' => "112233445566",
                'created_at' => Carbon::now('+7:00')->subDays(29),
                'updated_at' => Carbon::now('+7:00')->subDays(29),
            ]
        );
    }
}
