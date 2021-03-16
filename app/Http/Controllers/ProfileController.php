<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;

class ProfileController extends Controller
{
    private $event_service;

    public function __construct()
    {
        $this->event_service = new EventService();
    }

    public function edit($id)
    {
        $participant = $this->event_service->editProfile($id);
        return view('profile', compact('participant'));
    }

    public function update(Request $request, $id)
    {
        $this->event_service->updateProfile($request, $id);
        return redirect('profile' . $id);
    }

    public function delete($id)
    {
        $this->event_service->deleteAccount($id);
        return redirect('logout');
    }
}
