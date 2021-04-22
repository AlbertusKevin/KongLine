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
        //todo: send email
        // $message = "Event yang kamu ajukan telah disetujui.";
        // $this->admin_service->sendEmail($id, $message);
        return redirect("/admin/petition")->with(["type" => 'success', 'message' => 'Event petisi telah berhasil dikonfirmasi.']);
    }

    public function rejectPetition(Request $request, $id)
    {
        //ubah status dari 0 menjadi 5
        $this->admin_service->rejectPetition($id);
        //todo: send email
        // $message = $request->rejectEvent;
        // $this->admin_service->sendEmail($id, $message);
        return redirect("/admin/petition")->with(["type" => 'success', 'message' => 'Penolakan Event petisi berhasil.']);
    }

    public function closePetition(Request $request, $id)
    {
        //ubah status dari 0 menjadi 3
        $this->admin_service->closePetition($id);
        //todo: send email
        // $message = $request->closeEvent;
        // $this->admin_service->sendEmail($id, $message);
        return redirect("/admin/petition")->with(["type" => 'success', 'message' => 'Penutupan Event petisi berhasil.']);
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

    public function getAllTransaction()
    {
        $transactions = $this->admin_service->getAllTransaction();
        return view('admin.listTransaction', compact('transactions'));
    }

    public function transactionType(Request $request)
    {
        return $this->admin_service->transactionType($request->typeTransaction);
    }

    public function searchTransaction(Request $request)
    {
        return $this->admin_service->searchTransaction($request->typeTransaction, $request->keyword);
    }

    public function getATransaction($id)
    {

        $transaction = $this->admin_service->getAUserTransaction($id);
        // dd($transaction);
        return view('admin.detailTransaction', compact('transaction'));
    }

    public function donationType(Request $request)
    {
        return $this->admin_service->donationType($request->typeDonation);
    }

    public function adminSortDonation(Request $request)
    {
        return $this->admin_service->adminSortDonation($request);
    }

    public function adminSearchDonation(Request $request)
    {
        return $this->admin_service->adminSearchDonation($request);
    }

    public function acceptDonation($id)
    {
        //ubah status dari 0 menjadi 1
        $this->admin_service->acceptDonation($id);
        //todo: send email
        // $message = "Event yang kamu ajukan telah disetujui.";
        // $this->admin_service->sendEmail($id, $message);
        return redirect("/admin/donation")->with(["type" => 'success', 'message' => 'Donasi telah berhasil dikonfirmasi']);
    }

    public function rejectDonation(Request $request, $id)
    {
        //ubah status dari 0 menjadi 5
        $this->admin_service->rejectDonation($id);
        //todo: send email
        // $message = $request->rejectEvent;
        // $this->admin_service->sendEmail($id, $message);
        return redirect("/admin/donation")->with(["type" => 'success', 'message' => 'Penolakan donasi telah berhasil.']);
    }

    public function closeDonation(Request $request, $id)
    {
        //ubah status dari 0 menjadi 3
        $this->admin_service->closeDonation($id);
        //todo: send email
        // $message = $request->closeEvent;
        // $this->admin_service->sendEmail($id, $message);
        return redirect("/admin/donation")->with(["type" => 'success', 'message' => 'Penutupan event donasi telah berhasil.']);
    }

    public function confirmTransaction($id)
    {
        //ambil id user dan id donasi
        $transaction = $this->admin_service->getAUserTransaction($id);

        //ubah status dari 0 menjadi 5, ubah data perhitungan
        $this->admin_service->updateCalculationAfterConfirmDonate($transaction);
        $this->admin_service->confirmTransaction($id);
        //todo: send email
        // $message = "Transaksi donasi Anda selesai diproses. Terimakasih telah berpartisipasi.";
        // $this->admin_service->sendEmail($id, $message);
        return redirect("/admin/donation/transaction")->with(["type" => 'success', 'message' => 'Transaksi telah berhasil disetujui.']);
    }

    public function rejectTransaction(Request $request, $id)
    {
        //ubah status dari 0 menjadi 5
        $this->admin_service->rejectTransaction($id);
        //todo: send email
        // $message = $request->rejectTransaction;
        // $this->admin_service->sendEmail($id, $message);
        return redirect("/admin/donation/transaction")->with(["type" => 'success', 'message' => 'Penolakan transaksi telah selesai.']);
    }
  public function sortListUser(Request $request)
    {
        $users =  $this->admin_service->sortListUser($request);
        $eventCount = $this->admin_service->countEventParticipate($users);
        $combine = [];
        $sortCountEvent = 
        $combine[] = $users;
        $combine[] = $eventCount;

        return json_encode($combine);
    }

    public function searchUser(Request $request)
    {
        return $this->admin_service->searchUser($request);
    }

    public function userInfo(Request $request)
    {
        return view('/admin/userAdmin');
}
}