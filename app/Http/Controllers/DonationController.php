<?php

namespace App\Http\Controllers;

use App\Domain\Donation\Model;
use App\Domain\Donation\Service\DonationService;
use App\Domain\Event\Service\EventService;
use App\Domain\Profile\Service\ProfileService;
use App\Domain\Helper\HelperService;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    private $donation_service;
    private $profile_service;
    private $event_service;

    public function __construct()
    {
        $this->donation_service = new DonationService();
        $this->profile_service = new ProfileService();
        $this->event_service = new EventService();
    }

    //! {{-- lewat ajax --}} untuk mengurutkan atau mencari donasi
    public function searchDonation(Request $request)
    {
        return $this->donation_service->searchDonation($request);
    }

    public function sortDonation(Request $request)
    {
        return $this->donation_service->sortDonation($request);
    }

    public function getListActiveDonation()
    {
        $this->donation_service->updateDeadlineStatusDonation();
        $donations = $this->donation_service->getListActiveDonation();
        $user = $this->profile_service->getAProfile();
        $categories = $this->event_service->getAllCategoriesEvent();
        $navbar = HelperService::getNavbar();

        return view('donation.donation', compact('donations', 'categories', 'user', 'navbar'));
    }

    public function getADonation($id)
    {
        $donation = $this->donation_service->getCompleteInformationADonation($id);
        $user = $this->profile_service->getAProfile();
        // cek apakah user ini pernah berpartisipasi di event ini
        $isParticipated = $this->event_service->checkParticipated($id, $user->id, DONATION);
        $userTransactionStatus = $this->donation_service->checkAnUserTransactionStatus($user->id, $donation['detail']->id);
        $message = $this->event_service->messageOfEvent($donation['detail']->status);
        $navbar = HelperService::getNavbar();

        return view(
            'donation.donationDetail',
            compact(
                'donation',
                'user',
                'isParticipated',
                'userTransactionStatus',
                'message',
                'navbar'
            )
        );
    }

    // Membuat event donasi baru
    public function getViewCreateDonation()
    {
        $user = $this->profile_service->getAProfile();
        $listCategory = $this->event_service->getAllCategoriesEvent();
        $listBank = $this->donation_service->getListOfBank();

        return view('donation.donationCreate', compact('user', 'listCategory', 'listBank'));
    }

    public function saveEventDonation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'purpose' => 'required|min:150',
            'category' => 'required',
            'donationTarget' => 'required|numeric',
            'deadline' => 'required|numeric',
            'photo' => 'required|image',
            'assistedSubject' => 'required',
            'bank' => 'required',
            'accountNumber' => 'required|numeric',
            'nominal' => 'required',
            'nominal.*' => 'numeric',
            'allocationFor' => 'required'
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/donation/create')->with(['type' => "error", 'message' => $messageError])->withInput();
        };

        $user = $this->profile_service->getAProfile();

        $donation = new Model\Donation(
            $user->id,
            $request->title,
            $request->file('photo'),
            $request->category,
            $request->purpose,
            0,
            Carbon::now('+7:00'),
            Carbon::now('+7:00'),
            0,
            $request->donationTarget,
            0,
            $request->assistedSubject,
            $request->bank,
            $request->accountNumber,
            $request->deadline,
        );

        $this->donation_service->storeDonationCreated($donation);
        $idDonation = $this->donation_service->getLastIdDonation()->id;

        for ($i = 0; $i < count($request->nominal); $i++) {
            $allocationDetail = new Model\DetailAllocation($idDonation, $request->allocationFor[$i], $request->nominal[$i]);
            $this->donation_service->storeDetailAllocation($allocationDetail);
        }

        return redirect('/donation')->with(['type' => "success", 'message' => 'Event Anda sudah didaftarkan. Tunggu konfirmasi dari admin.']);
    }

    // Mengubah data event donasi yang diajukan selama belum berlangsung (menunggu konfirmasi atau telah ditolak.)
    public function getViewEditDonation($id)
    {
        $user = $this->profile_service->getAProfile();
        $donation = $this->donation_service->getADonation($id);
        $listCategory = $this->event_service->getAllCategoriesEvent();
        $listBank = $this->donation_service->getListOfBank();
        $detailAllocation = $this->donation_service->getDetailAllocation($id);
        return view('donation.donationEdit', compact('user', 'donation', 'listCategory', 'listBank', 'detailAllocation'));
    }

    public function updateEventDonation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'purpose' => 'required|min:150',
            'category' => 'required',
            'donationTarget' => 'required|numeric',
            'deadline' => 'required|numeric',
            'assistedSubject' => 'required',
            'bank' => 'required',
            'accountNumber' => 'required|numeric',
            'nominal' => 'required',
            'nominal.*' => 'numeric',
            'allocationFor' => 'required'
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/donation/edit/' . $id)->with(['type' => "error", 'message' => $messageError])->withInput();
        };

        $user = $this->profile_service->getAProfile();
        $oldDonation = $this->donation_service->getADonation($id);
        $file = $oldDonation->photo;
        $empty = true;

        // jika file ingin diperbarui
        if (!empty($request->file())) {
            $file = $request->file('photo');
            $empty = false;
        }

        $donation = new Model\Donation(
            $user->id,
            $request->title,
            $file,
            $request->category,
            $request->purpose,
            0,
            $oldDonation->created_at,
            Carbon::now('+7:00'),
            0,
            $request->donationTarget,
            0,
            $request->assistedSubject,
            $request->bank,
            $request->accountNumber,
            $request->deadline
        );
        // update data donasi
        $this->donation_service->updateEventDonation($donation, $id, $empty);
        // hapus detail allocation yang id-nya $id
        $this->donation_service->deleteAllocationDetail($id);
        // insert detail allocation yang baru
        for ($i = 0; $i < count($request->nominal); $i++) {
            $allocationDetail = new Model\DetailAllocation($id, $request->allocationFor[$i], $request->nominal[$i]);
            $this->donation_service->storeDetailAllocation($allocationDetail);
        }

        return redirect('/donation/edit/' . $id)->with(['type' => "success", 'message' => 'Event Anda berhasil diperbarui.']);
    }

    // Menyimpan keterangan partisipasi user dalam sebuah donasi, belum mengkonfirmasi pembayaran
    public function getDonateForm($id)
    {
        $user = $this->profile_service->getAProfile();
        $donation = $this->donation_service->getADonation($id);
        return view('donation.donateForm', compact('user', 'donation'));
    }

    public function postDonate(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'nominal' => 'required',
            'rekeningUser' => 'required|numeric',
            'comment' => 'nullable|min:20'
        ]);

        $nominal = $this->donation_service->preprocessNominalDonation($request);

        if ($nominal == "not_number") {
            return redirect('/donation/donate/' . $id)->withInput()->with(['type' => "error", 'message' => 'Input nominal harus berupa angka']);
            if ($nominal == "below_min") {
                return redirect('/donation/donate/' . $id)->withInput()->with(['type' => "error", 'message' => 'Donasi minimal ' . MIN_DONATION]);
            }
        }

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/donation/donate/' . $id)->withInput()->with(['type' => "error", 'message' => $messageError]);
        };

        $user = $this->profile_service->getAProfile();
        $annonymousComment = $this->event_service->checkAnnonym($request->annonymousComment);
        $annonymousDonate = $this->event_service->checkAnnonym($request->annonymousDonatur);

        $participateDonation = new Model\ParticipateDonation($id, $user->id, $request->comment, Carbon::now('+7:00'), $annonymousComment);
        $transaction = new Model\Transaction($id, $user->id, $request->rekeningUser, $nominal, $annonymousDonate, 0, Carbon::now('+7:00'), Carbon::now('+7:00'));
        $this->donation_service->postDonate($participateDonation);
        $this->donation_service->postTransaction($transaction);

        return redirect('/donation/confirm_donate/' . $id)->with(['type' => "success", 'message' => 'Donasi Anda telah ditambahkan. Lanjutkan ke konfirmasi pembayaran.']);
    }

    // Mengkonfirmasi pembayaran donasi, setelah mengisi data untuk berdonasi pada suatu event
    public function formPaymentConfirm($id)
    {
        $donation = $this->donation_service->getADonation($id);
        $user = $this->profile_service->getAProfile();
        $transaction = $this->donation_service->getAUserTransaction($user->id, $id);
        return view('donation.donateConfirm', compact('donation', 'user', 'transaction'));
    }

    public function postPaymentConfirm(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'repaymentPicture' => 'required|image'
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/donation/confirm_donate/' . $id)->withInput()->with(['type' => "error", 'message' => $messageError]);
        };

        $this->donation_service->confirmationPictureDonation($request->file('repaymentPicture'), $id);

        return redirect('/donation/' . $id)->with(['type' => "success", 'message' => 'Konfirmasi pembayaran akan segera diproses']);
    }

    // Mengubah data rincian transaksi donasi pada suatu event sebelum dikonfirmasi atau telah ditolak admin
    public function getViewEditDonate($id)
    {
        $user = $this->profile_service->getAProfile();
        $donation = $this->donation_service->getADonation($id);
        $transaction = $this->donation_service->getAUserTransaction($user->id, $id);

        return view('donation.donateEdit', compact('user', 'donation', 'transaction'));
    }

    public function updateDonate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'repaymentPicture' => 'image'
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/donation/donate/edit/' . $id)->withInput()->with(['type' => "error", 'message' => $messageError]);
        };

        if (!empty($request->file('repaymentPicture'))) {
            $this->donation_service->confirmationPictureDonation($request->file('repaymentPicture'), $id);
        } else {
            $this->donation_service->updateTransactionDonation($id);
        }

        return redirect('/donation/' . $id)->with(['type' => "success", 'message' => 'Konfirmasi pembayaran akan segera diproses']);
    }
}
