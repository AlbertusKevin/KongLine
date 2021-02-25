<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;

class EventController extends Controller
{
    private $eventService;

    public function __construct()
    {
        $this->eventService = new EventService();
    }

    public function showProfile($request)
    {
        return $this->eventService->showProfile($request->session()->get('id_user'));
    }

    public function indexPetition(Request $request)
    {
        $user = $this->showProfile($request);
        $petitionList = $this->eventService->indexPetition();
        return view('petition', compact('petitionList', 'user'));
    }

    public function showPetition(Request $request, $idEvent)
    {
        $petition = $this->eventService->showPetition($idEvent);
        $user = $this->showProfile($request);
        $isParticipated = $this->eventService->checkParticipated($idEvent, $request->session()->get('id_user'), 'petition');

        return view('petitionDetail', compact('petition', 'user', 'isParticipated'));
    }
}
