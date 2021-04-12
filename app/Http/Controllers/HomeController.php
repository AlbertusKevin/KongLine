<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private $eventService;

    public function __construct()
    {
        $this->eventService = new EventService();
    }

    public function index()
    {
        $svc = new EventService();
        $donasi = $svc->getDonationLimit();
        $petition = $svc->getPetitionLimit();
        return view('home', [
            'donasi' => $donasi,
            'petisi' => $petition, 
        ]);
    }
}
