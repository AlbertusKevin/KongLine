<?php

namespace App\Http\Controllers;

use App\Domain\Communication\Service\CommunicationService;
use App\Domain\Donation\Service\DonationService;
use App\Domain\Petition\Service\PetitionService;
use App\Domain\Profile\Service\ProfileService;

class HomeController extends Controller
{
    private $profile_service;
    private $comm_service;
    private $donation_service;
    private $petition_service;

    public function __construct()
    {
        $this->profile_service = new ProfileService();
        $this->donation_service = new DonationService();
        $this->petition_service = new PetitionService();
        $this->comm_service = new CommunicationService();
    }

    public function index()
    {
        $donasi = $this->donation_service->getThreeActiveDonation();
        $petisi = $this->petition_service->getActivePetition()->take(3);

        $users = $this->profile_service->getUsers();
        $user = $this->profile_service->getAProfile();

        if ($user->role == GUEST) {
            return view('home', compact('user', 'donasi', 'petisi'));
        }

        if ($user->role == ADMIN) {
            $messages = $this->comm_service->getContactMessages($user);
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
