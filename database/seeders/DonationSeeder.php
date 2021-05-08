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
                'photo' => 'images/donation/pantiAsuhan.jpeg',
                'title' => 'Bantu perpanjangan kontrak Panti Asuhan Sejahtera Bersama',
                'idCampaigner' => 11,
                'category' => 12,
                'status' => 0,
                'deadline' => Carbon::create('2021', '06', '08')->format("Y-m-d"),
                'purpose' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, fugiat, nobis inventore cupiditate porro a non fugit maxime possimus repellendus officiis iusto blanditiis deserunt asperiores quia quod nemo adipisci dicta exercitationem sequi doloribus cum ipsum! Tempore quis, id praesentium accusamus, ea aut expedita quo atque neque dolore optio eum sed aliquam. Dignissimos velit earum tempora in recusandae cupiditate eligendi, aliquam est obcaecati corrupti eos odio exercitationem iste totam ipsum sequi! Fuga iure repudiandae impedit, illum corporis alias. Explicabo modi voluptatibus ipsum nisi omnis vel saepe rerum unde repellat nam delectus velit ea cumque, aperiam facere enim! Corporis earum debitis aperiam?',
                'assistedSubject' => 'Panti Asuhan',
                'donationCollected' => 16000000,
                'donationTarget' => 1500000,
                'bank' => 1,
                'accountNumber' => "112233445566"
            ]
        );
    }
}
