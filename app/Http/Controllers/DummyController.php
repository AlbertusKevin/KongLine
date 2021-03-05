<?php

namespace App\Http\Controllers;

use App\Domain\Event\Entity\Donation;
use Carbon\Carbon;

class DummyController extends Controller
{
    public function cobaModifikasiEntity()
    {
        // instansiasi objek di service
        $donation = new Donation();

        $donation->title = "uji coba";
        $donation->photo = "photo";
        $donation->category = 1;
        $donation->purpose = "purpose";
        $donation->deadline = Carbon::now()->format('Y-m-d');
        $donation->status = 1;
        $donation->created_at = Carbon::now()->format('Y-m-d');
        $donation->assistedSubject = "assisted subject";
        $donation->donationCollected = 56000;
        $donation->donationTarget = 1000000;
        $donation->idCampaigner = 1;

        //simpan objek ke database di DAO: metode save();
        // $donation->save();

        //simpan objek ke database di DAO: ORM
        Donation::create([
            'title' => $donation->title,
            'photo' => $donation->photo,
            'category' => $donation->category,
            'purpose' => $donation->purpose,
            'deadline' => $donation->deadline,
            'status' => $donation->status,
            'created_at' => $donation->created_at,
            'assistedSubject' => $donation->assistedSubject,
            'donationCollected' => $donation->donationCollected,
            'donationTarget' => $donation->donationTarget,
            'idCampaigner' => $donation->idCampaigner
        ]);
    }
}
