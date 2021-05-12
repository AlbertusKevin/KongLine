<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Controlling\Service\ControllingService;
use App\Domain\Helper\HelperService;
use App\Domain\Profile\Service\ProfileService;

class ControllingController extends Controller
{
    private $controlling_service;
    private $profile_service;

    public function __construct()
    {
        $this->controlling_service = new ControllingService();
        $this->profile_service = new ProfileService();
    }
    public function home()
    {
        $dashboard_data = $this->controlling_service->getAdminDashboardData();
        return view('admin.home', compact('dashboard_data'));
    }

    //? ========================================
    //! ~~~~~~~~~~~~~~~~ Petisi ~~~~~~~~~~~~~~~~
    //? ========================================
    public function getListPetition()
    {
        $listCategory = HelperService::getAllCategoriesEvent();
        $petitionList = $this->controlling_service->allPetition();
        return view('admin.listPetition', compact('listCategory', 'petitionList'));
    }

    public function acceptPetition($id)
    {
        //ubah status dari 0 menjadi 1
        $this->controlling_service->acceptPetition($id);
        //todo: send email
        $view = "auth.eventConfirmEmail";
        $message = "Event Disetujui";
        $this->controlling_service->sendEmailPetition($id, $view, $message);

        return redirect("/admin/petition")->with(["type" => 'success', 'message' => 'Event petisi telah berhasil dikonfirmasi.']);
    }

    public function rejectPetition(Request $request, $id)
    {
        $reason = $request->rejectEvent;
        //ubah status dari 0 menjadi 5
        $this->controlling_service->rejectPetition($id, $reason);
        //todo: send email
        $view = "auth.eventRejectEmail";
        $message = "Event Ditolak.";
        $this->controlling_service->sendEmailPetition($id, $view, $message);

        return redirect("/admin/petition")->with(["type" => 'success', 'message' => 'Penolakan Event petisi berhasil.']);
    }

    public function closePetition(Request $request, $id)
    {
        $reason = $request->closeEvent;
        //ubah status dari 0 menjadi 3
        $this->controlling_service->closePetition($id, $reason);
        //todo: send email
        $view = "auth.eventCloseEmail";
        $message = "Event Ditutup";
        $this->controlling_service->sendEmailPetition($id, $view, $message);

        return redirect("/admin/petition")->with(["type" => 'success', 'message' => 'Penutupan Event petisi berhasil.']);
    }

    //? ========================================
    //! ~~~~~~~~~~~~~~~~ Donasi ~~~~~~~~~~~~~~~~
    //? ========================================
    public function getListDonation()
    {
        $listCategory = $this->event_service->getAllCategoriesEvent();
        $donationList = $this->controlling_service->allDonation();

        return view("admin.listDonation", compact('listCategory', 'donationList'));
    }

    public function getAllTransaction()
    {
        $transactions = $this->controlling_service->getAllTransaction();
        return view('admin.listTransaction', compact('transactions'));
    }

    public function transactionType(Request $request)
    {
        return $this->controlling_service->transactionType($request->typeTransaction);
    }

    public function searchTransaction(Request $request)
    {
        return $this->controlling_service->searchTransaction($request->typeTransaction, $request->keyword);
    }

    public function getATransaction($id)
    {

        $transaction = $this->controlling_service->getAUserTransaction($id);
        // dd($transaction);
        return view('admin.detailTransaction', compact('transaction'));
    }

    public function donationType(Request $request)
    {
        return $this->controlling_service->donationType($request->typeDonation);
    }

    public function adminSortDonation(Request $request)
    {
        return $this->controlling_service->adminSortDonation($request);
    }

    public function adminSearchDonation(Request $request)
    {
        return $this->controlling_service->adminSearchDonation($request);
    }

    public function acceptDonation($id)
    {
        //ubah status dari 0 menjadi 1
        $this->controlling_service->acceptDonation($id);
        //todo: send email
        $view = "auth.eventConfirmEmail";
        $message = "Event Disetujui.";
        $this->controlling_service->sendEmailDonation($id, $view, $message);

        return redirect("/admin/donation")->with(["type" => 'success', 'message' => 'Donasi telah berhasil dikonfirmasi']);
    }

    public function rejectDonation(Request $request, $id)
    {
        $reason = $request->rejectEvent;
        //ubah status dari 0 menjadi 5
        $this->controlling_service->rejectDonation($id, $reason);
        //todo: send email
        $view = "auth.eventRejectEmail";
        $message = "Event Ditolak";
        $this->controlling_service->sendEmailDonation($id, $view, $message);

        return redirect("/admin/donation")->with(["type" => 'success', 'message' => 'Penolakan donasi telah berhasil.']);
    }

    public function closeDonation(Request $request, $id)
    {
        $reason = $request->closeEvent;
        //ubah status dari 0 menjadi 3
        $this->controlling_service->closeDonation($id, $reason);
        //todo: send email
        $view = "auth.eventCloseEmail";
        $message = "Event Ditutup.";
        $this->controlling_service->sendEmailDonation($id, $view, $message);

        return redirect("/admin/donation")->with(["type" => 'success', 'message' => 'Penutupan event donasi telah berhasil.']);
    }

    public function confirmTransaction($id)
    {

        //ambil id user dan id donasi
        $transaction = $this->controlling_service->getAUserTransaction($id);

        //ubah status dari 0 menjadi 5, ubah data perhitungan
        $this->controlling_service->updateCalculationAfterConfirmDonate($transaction);
        $this->controlling_service->confirmTransaction($id);
        // //todo: send email
        $view = "auth.trxConfirmEmail";
        $message = "Transaksi donasi Anda selesai diproses";
        $this->controlling_service->sendEmailTransaction($id, $view, $message);
        return redirect("/admin/donation/transaction")->with(["type" => 'success', 'message' => 'Transaksi telah berhasil disetujui.']);
    }

    public function rejectTransaction(Request $request, $id)
    {
        $reason = $request->rejectTransaction;
        //ubah status dari 0 menjadi 5
        $this->controlling_service->rejectTransaction($id, $reason);
        //todo: send email
        $view = "auth.trxRejectEmail";
        $message = "Transaksi donasi Anda ditolak";
        $this->controlling_service->sendEmailTransaction($id, $view, $message);
        return redirect("/admin/donation/transaction")->with(["type" => 'success', 'message' => 'Penolakan transaksi telah selesai.']);
    }

    //? ========================================
    //! ~~~~~~~~~~~~~~~~~ Users ~~~~~~~~~~~~~~~~
    //? ========================================
    public function sortListUser(Request $request)
    {
        $users =  $this->controlling_service->sortListUser($request);
        $eventCount = $this->controlling_service->countEventParticipate($users);
        $combine = [];
        $combine[] = $users;
        $combine[] = $eventCount;

        return json_encode($combine);
    }

    public function searchUser(Request $request)
    {
        return $this->controlling_service->searchUser($request);
    }

    public function getUserInfo($id)
    {

        $user = $this->controlling_service->getUserInfo($id);
        $events = $this->controlling_service->getEventsUser($id);
        $eventMade = $this->controlling_service->countEventMade($id);

        $countDonation = $events[0]->count();
        $countPetition = $events[1]->count();
        $countTotal = $countDonation + $countPetition;
        // dd($countTotal);
        return view('admin.userAdmin', compact('user', 'events', 'countTotal', 'eventMade'));
    }

    public function getEventParticipate($id)
    {
        return $this->controlling_service->getEventsUser($id);
    }

    public function getEventMade($id)
    {
        return $this->controlling_service->getEventsMade($id);
    }

    public function acceptUserToCampaigner($id)
    {

        $view = "auth.userAcceptEmail";
        $message = "Pengajuan Campaigner Diterima";

        $this->controlling_service->acceptUserToCampaigner($id, $view, $message);
        return redirect("/admin/user/$id")->with(["type" => 'success', 'message' => 'User berhasil upgrade ke campaigner']);
    }

    public function rejectUserToCampaigner($id)
    {
        $view = "auth.userRejectEmail";
        $message = "Pengajuan Campaigner Ditolak";
        $this->controlling_service->rejectUserToCampaigner($id, $view, $message);
        return redirect("/admin/user/$id")->with(["type" => 'fail', 'message' => 'User ditolak upgrade ke campaigner']);
    }

    public function getAllUsers()
    {
        $users = $this->controlling_service->getAllUser();
        $eventCount = $this->controlling_service->countEventParticipate($users);
        $changeDateFormat = $this->controlling_service->changeDateFormat();
        return view('/admin/listUser', compact('users', 'eventCount', 'changeDateFormat'));
    }

    public function getUsersByRole(Request $request)
    {
        $users = $this->controlling_service->getUsersByRole($request);
        $eventCount = $this->controlling_service->countEventParticipate($users);
        $combine = [];
        $combine[] = $users;
        $combine[] = $eventCount;

        return json_encode($combine);
    }

    public function countEventParticipate(Request $request)
    {
        return $this->controlling_service->countEventParticipate($request);
    }
}
