<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;
=======
use \App\Domain\Event\Entity\User;
use \App\Domain\Communication\Entity\Service;
use App\Domain\Event\Service\EventService;
use Illuminate\Support\Facades\Auth;
>>>>>>> master

class HomeController extends Controller
{
    private $eventService;

    public function __construct()
    {
        $this->eventService = new EventService();
    }
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
<<<<<<< HEAD
        $svc = new EventService();
        $donasi = $svc->getDonationLimit();
        $petition = $svc->getPetitionLimit();
        return view('home', [
            'donasi' => $donasi,
            'petisi' => $petition, 
=======
        $users = User::orderBy('id', 'DESC')->get();
        $user = $this->eventService->showProfile();

        if ($user->role == GUEST) {
            return view('home', compact('user'));
        }

        if ($user->role == ADMIN) {
            $messages = Service::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        }

        return view('home', [
            'users' => $users,
            'messages' => $messages ?? null,
            'user' => $user
>>>>>>> master
        ]);
    }
}
