<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{
    private $eventService;

    public function __construct()
    {
        $this->eventService = new EventService();
    }

    public function indexPetition(Request $request)
    {
        $user = Auth::user();
        $petitionList = $this->eventService->indexPetition();
        return view('petition', compact('petitionList', 'user'));
    }

    public function listPetitionType(Request $request)
    {
        return $this->eventService->listPetitionType($request);
    }

    public function searchPetition(Request $request)
    {
        return $this->eventService->searchPetition($request);
    }

    public function sortPetition(Request $request)
    {
        return $this->eventService->sortPetition($request);
    }

    public function showPetition(Request $request, $idEvent)
    {
        $petition = $this->eventService->showPetition($idEvent);
        $user = Auth::user();
        $isParticipated = $this->eventService->checkParticipated($idEvent, $user->id, 'petition');

        return view('petitionDetail', compact('petition', 'user', 'isParticipated'));
    }

    public function signPetition(Request $request, $idEvent)
    {
        $user = Auth::user();
        $this->eventService->signPetition($request, $idEvent, $user);
        Alert::success('Berhasil Menandatangai petisi ini.', 'Terimakasih ikut berpartisipasi!');
        return redirect("/petisi/" . $idEvent);
    }
}
