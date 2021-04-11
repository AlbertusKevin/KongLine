<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Admin\Service\AdminService;
use App\Domain\Event\Service\EventService;

class AdminController extends Controller
{
    private $admin_service;
    private $eventService;

    public function __construct()
    {
        $this->admin_service = new AdminService();
        $this->eventService = new EventService();
    }

    public function getAll()
    {
        $users = $this->admin_service->getAllUser();
        $eventCount = $this->admin_service->countEventParticipate($users);
        $changeDateFormat = $this->admin_service->changeDateFormat();
        return view('/admin/listUser', compact('users', 'eventCount', 'changeDateFormat'));
    }

    public function listUserByRole(Request $request)
    {
        $users = $this->admin_service->listUserByRole($request);
        $eventCount = $this->admin_service->countEventParticipate($users);
        $combine = [];
        $combine[] = $users;
        $combine[] = $eventCount;

        return json_encode($combine);
    }

    public function countEventParticipate(Request $request)
    {
        return $this->admin_service->countEventParticipate($request);
    }

    public function home()
    {
        $users = $this->admin_service->countUser();
        $participant =  $this->admin_service->countParticipant();
        $campaigner  = $this->admin_service->countCampaigner();
        $campaigner_waiting  = $this->admin_service->countWaitingCampaigner();
        $donasi_waiting = $this->admin_service->countWaitingDonation();
        $petisi_waiting = $this->admin_service->countWaitingPetition();
        $donations = $this->admin_service->getDonationLimit();
        $petitions = $this->admin_service->getPetitionLimit();
        $date = $this->admin_service->getDate();

        return view('admin.home', [
            'users' => $users,
            'participant' => $participant,
            'campaigner' => $campaigner,
            'waiting_campaigner' => $campaigner_waiting,
            'waiting_donation' => $donasi_waiting,
            'waiting_petition' => $petisi_waiting,
            'donations' => $donations,
            'petitions' => $petitions,
            'date' => $date,
        ]);
    }

    //? ========================================
    //! ~~~~~~~~~~~~~~~~ Petisi ~~~~~~~~~~~~~~~~
    //? ========================================
    public function getListPetition()
    {
        $listCategory = $this->eventService->listCategory();
        $petitionList = $this->admin_service->allPetition();
        // dd($petitionList);
        return view('admin.listPetition', compact('listCategory', 'petitionList'));
    }

    public function acceptPetition($id)
    {
        //ubah status dari 0 menjadi 1
        $this->admin_service->acceptPetition($id);
        //send email bahwa petisi yang dibuat sudah disetujui
        $message = "Event yang kamu ajukan telah disetujui.";
        $this->admin_service->sendEmail($id, $message);
    }

    public function rejectPetition(Request $request, $id)
    {
        //ubah status dari 0 menjadi 5
        $this->admin_service->rejectPetition($id);
        //send email bahwa petisi yang dibuat sudah disetujui
        $message = $request->rejectEvent;
        $this->admin_service->sendEmail($id, $message);
    }

    public function closePetition(Request $request, $id)
    {
        //ubah status dari 0 menjadi 3
        $this->admin_service->closePetition($id);
        //send email bahwa petisi yang dibuat sudah disetujui
        $message = $request->closeEvent;
        $this->admin_service->sendEmail($id, $message);
    }

    //? ========================================
    //! ~~~~~~~~~~~~~~~~ Donasi ~~~~~~~~~~~~~~~~
    //? ========================================
    public function getListDonation()
    {
        $listCategory = $this->eventService->listCategory();
        $donationList = $this->admin_service->allDonation();

        return view("admin.listDonation", compact('listCategory', 'donationList'));
    }

    public function adminSortDonation(Request $request)
    {
        return $this->admin_service->adminSortDonation($request);
    }
}
