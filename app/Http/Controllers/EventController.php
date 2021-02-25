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

    public function indexPetition()
    {
        $petitionList = $this->eventService->indexPetition();
        return view('petition', compact('petitionList'));
    }
}
