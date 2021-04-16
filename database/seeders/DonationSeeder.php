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
        DB::table('donation')->insert(
            [
                'category' => 12,
                'deadline' => Carbon::create('2021', '04', '28')->format("Y-m-d"),
                'idCampaigner' => 11,
                'photo' => 'images/donation/pantiAsuhan.jpeg',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 0,
                'title' => 'Bantu perpanjangan kontrak Panti Asuhan Sejahtera Bersama',
                'assistedSubject' => 'Panti Asuhan',
                'donationCollected' => 16000000,
                'donationTarget' => 1500000,
                'created_at' => Carbon::now()->format('Y-m-d'),
                'bank' => 1,
                'accountNumber' => "112233445566"
            ]
        );
        DB::table('donation')->insert(
            [
                'category' => 9,
                'deadline' => Carbon::create('2021', '04', '28')->format("Y-m-d"),
                'idCampaigner' => 12,
                'photo' => 'images/donation/tupperware.jpg',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 1,
                'title' => 'Bantu Wan membeli Tupperwarenya yang hilang',
                'assistedSubject' => 'Kehidupan Sosial',
                'donationCollected' => 50000,
                'donationTarget' => 42000,
                'created_at' => Carbon::now()->format('Y-m-d'),
                'bank' => 2,
                'accountNumber' => "18283681623"
            ]
        );
        DB::table('donation')->insert(
            [
                'category' => 7,
                'deadline' => Carbon::create('2021', '04', '15')->format("Y-m-d"),
                'idCampaigner' => 13,
                'photo' => 'images/donation/telorGulung.jpg',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 1,
                'title' => 'Bantu Pak Udil membangun usaha telor gulung',
                'assistedSubject' => 'Pekerjaan',
                'donationCollected' => 5000000,
                'donationTarget' => 1250000,
                'created_at' => Carbon::now()->format('Y-m-d'),
                'bank' => 3,
                'accountNumber' => "2876201623"
            ]
        );
        DB::table('donation')->insert(
            [
                'category' => 1,
                'deadline' => Carbon::create('2021', '03', '24')->format("Y-m-d"),
                'idCampaigner' => 11,
                'photo' => 'images/donation/androidStudio.png',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 2,
                'title' => 'Bantu Bokir membeli RAM untuk mengerjakan Tugas Android',
                'assistedSubject' => 'Mahasiswa',
                'donationCollected' => 750000,
                'donationTarget' => 750000,
                'created_at' => Carbon::create('2021', '03', '15')->format("Y-m-d"),
                'bank' => 4,
                'accountNumber' => "112233445566"
            ]
        );
        DB::table('donation')->insert(
            [
                'category' => 5,
                'deadline' => Carbon::create('2021', '03', '26')->format("Y-m-d"),
                'idCampaigner' => 10,
                'photo' => 'images/donation/hpTiktok.jpg',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 2,
                'title' => 'Bantu Bu Yanti membeli HP untuk bermain TikTok',
                'assistedSubject' => 'Pekerjaan',
                'donationCollected' => 2500000,
                'donationTarget' => 2500000,
                'created_at' => Carbon::create('2021', '03', '17')->format("Y-m-d"),
                'bank' => 1,
                'accountNumber' => "0972289566"
            ]
        );
        DB::table('donation')->insert(
            [
                'category' => 13,
                'deadline' => Carbon::create('2021', '04', '06')->format("Y-m-d"),
                'idCampaigner' => 12,
                'photo' => 'images/donation/gereja.jpg',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 3,
                'title' => 'Bantu Pembangunan rumah Ibadah di Makasar',
                'assistedSubject' => 'Rumah Ibadah',
                'donationCollected' => 800000000,
                'donationTarget' => 800000000,
                'created_at' => Carbon::create('2021', '03', '17')->format("Y-m-d"),
                'bank' => 3,
                'accountNumber' => "09876281"
            ]
        );
        DB::table('donation')->insert(
            [
                'category' => 3,
                'deadline' => Carbon::create('2021', '03', '30')->format("Y-m-d"),
                'idCampaigner' => 11,
                'photo' => 'images/donation/gereja.jpg',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 3,
                'title' => 'Bantu Tatang Berobat',
                'assistedSubject' => 'Difabel',
                'donationCollected' => 15000000,
                'donationTarget' => 15000000,
                'created_at' => Carbon::create('2021', '03', '20')->format("Y-m-d"),
                'bank' => 3,
                'accountNumber' => "55674298312"
            ]
        );
        DB::table('donation')->insert(
            [
                'category' => 5,
                'deadline' => Carbon::create('2021', '04', '10')->format("Y-m-d"),
                'idCampaigner' => 12,
                'photo' => 'images/donation/keyboard.jpg',
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'status' => 4,
                'title' => 'Bantu Hizkia Membeli Keyboard',
                'assistedSubject' => 'Hardware',
                'donationCollected' => 1500000,
                'donationTarget' => 1500000,
                'created_at' => Carbon::create('2021', '03', '30')->format("Y-m-d"),
                'bank' => 2,
                'accountNumber' => "332086539123"
            ]
        );
    }
}
