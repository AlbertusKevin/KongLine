<?php

namespace App\Http\Controllers;

use \App\Domain\Profile\Entity\User;
use \App\Domain\Communication\Entity\Service;
use App\Domain\Helper\HelperService;
use App\Domain\Profile\Service\ProfileService;

class HomeController extends Controller
{
    private $profile_service;

    public function __construct()
    {
        $this->profile_service = new ProfileService();
    }

    public function index()
    {
        // stub
        $donasi = HelperService::getDonationLimit();
        $petisi = HelperService::getPetitionLimit();

        $users = User::orderBy('id', 'DESC')->get();
        $user = $this->profile_service->getAProfile();

        if ($user->role == GUEST) {
            return view('home', compact('user', 'donasi', 'petisi'));
        }

        if ($user->role == ADMIN) {
            $messages = Service::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        }

        return view('home', [
            'users' => $users,
            'messages' => $messages ?? null,
            'user' => $user,
            'donasi' => $donasi,
            'petisi' => $petisi,
        ]);
    }
}
