<?php

namespace App\Http\Controllers;

use App\Domain\Donation\Model;
use App\Domain\Donation\Service\DonationService;
use App\Domain\Helper\HelperService;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use App\Domain\Profile\Service\ProfileService;

class DonationController extends Controller
{
    private $donation_service;
    private $profile_service;

    public function __construct()
    {
        $this->donation_service = new DonationService();
        $this->profile_service = new ProfileService();
    }

    public function getAllDonation()
    {
        $donations = $this->donation_service->getListDonation();
        $user = $this->profile_service->getAProfile();
        $categories = HelperService::getAllCategoriesEvent();
        $navbar = HelperService::getNavbar();


        return view('donation.donation', compact('donations', 'categories', 'user', 'navbar'));
    }

    public function getADonation($id)
    {
        $donation = $this->donation_service->getADonation($id); // detail donasi mencakup siapa pembuat event itu
        $user = $this->profile_service->getAProfile();
        $progress = $this->donation_service->countProgressDonation($donation); // untuk progress bar
        $participatedDonation = $this->donation_service->getParticipatedDonation($id); // untuk tab donatur dan comment
        $alocationBudget = $this->donation_service->getABudgetingDonation($id); // untuk tab alokasi dana
        // pengecekan, apakah donasi di event ini sudah dikonfirmasi pembayaran oleh user
        $userTransactionStatus = $this->donation_service->checkUserTransactionStatus($participatedDonation, $user->id);
        $allStatusZero = $this->donation_service->checkStatusIsZero($participatedDonation);

        $category = HelperService::getACategory($donation->category); // untuk menampilkan kategori
        $isParticipated = HelperService::checkParticipated($id, $user, DONATION); // untuk pengecekan apakah pernah donasi atau tidak
        $message = HelperService::messageOfEvent($donation->status); // Menampilkan pesan status sebuah event
        $navbar = HelperService::getNavbar();

        return view(
            'donation.donationDetail',
            compact(
                'donation',
                'user',
                'progress',
                'category',
                'participatedDonation',
                'alocationBudget',
                'isParticipated',
                'message',
                'userTransactionStatus',
                'allStatusZero',
                'navbar'
            )
        );
    }

    public function formDonate($id)
    {
        $user = $this->profile_service->getAProfile();
        $donation = $this->donation_service->getADonation($id);
        return view('donation.donateForm', compact('user', 'donation'));
    }

    public function postDonate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nominal' => 'required|numeric|min:10000',
            'rekeningUser' => 'required|numeric',
            'comment' => 'nullable|min:20'
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/donation/donate/' . $id)->withInput()->with(['type' => "error", 'message' => $messageError]);
        };

        $user = $this->profile_service->getAProfile();
        $annonymousComment = HelperService::checkAnnonym($request->annonymousComment);
        $annonymousDonate = HelperService::checkAnnonym($request->annonymousDonatur);

        $participateDonation = new Model\ParticipateDonation($id, $user->id, $request->comment, Carbon::now()->format('Y-m-d'), $annonymousComment);
        $transaction = new Model\Transaction($id, $user->id, $request->rekeningUser, $request->nominal, $annonymousDonate, 0, Carbon::now()->format("Y-m-d"));
        $this->donation_service->postDonate($participateDonation);
        $this->donation_service->postTransaction($transaction);

        return redirect('/donation/confirm_donate/' . $id)->with(['type' => "success", 'message' => 'Donasi Anda telah ditambahkan. Lanjutkan ke konfirmasi pembayaran.']);
    }

    public function formConfirm($id)
    {
        $donation = $this->donation_service->getADonation($id);
        $user = $this->profile_service->getAProfile();
        $transaction = $this->donation_service->getAUserTransaction($user->id, $id);
        return view('donation.donateConfirm', compact('donation', 'user', 'transaction'));
    }

    public function postConfirm(Request $request, $id)
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

    public function createView()
    {
        $user = $this->profile_service->getAProfile();
        $listCategory = HelperService::getAllCategoriesEvent();
        $listBank = $this->donation_service->listBank();

        return view('donation.donationCreate', compact('user', 'listCategory', 'listBank'));
    }

    public function storeDonation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'purpose' => 'required|min:150',
            'category' => 'required',
            'donationTarget' => 'required|numeric',
            'deadline' => 'required',
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
            $request->deadline,
            0,
            Carbon::now()->format("Y-m-d"),
            0,
            $request->donationTarget,
            0,
            $request->assistedSubject,
            $request->bank,
            $request->accountNumber
        );

        $this->donation_service->storeDonationCreated($donation);
        $idDonation = $this->donation_service->getLastIdDonation()->id;

        for ($i = 0; $i < count($request->nominal); $i++) {
            $allocationDetail = new Model\DetailAllocation($idDonation, $request->allocationFor[$i], $request->nominal[$i]);
            $this->donation_service->storeDetailAllocation($allocationDetail);
        }

        return redirect('/donation')->with(['type' => "success", 'message' => 'Event Anda sudah didaftarkan. Tunggu konfirmasi dari admin.']);
    }

    public function editDonate($id)
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

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai keyword yang diketik
    public function searchDonation(Request $request)
    {
        return $this->donation_service->searchDonation($request);
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function sortDonation(Request $request)
    {
        return $this->donation_service->sortDonation($request);
    }

    public function editDonation($id)
    {
        $user = $this->profile_service->getAProfile();
        $donation = $this->donation_service->getADonation($id);
        $listCategory = HelperService::getAllCategoriesEvent();
        $listBank = $this->donation_service->listBank();
        $detailAllocation = $this->donation_service->getDetailAllocation($id);
        return view('donation.donationEdit', compact('user', 'donation', 'listCategory', 'listBank', 'detailAllocation'));
    }

    public function updateDonation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'purpose' => 'required|min:150',
            'category' => 'required',
            'donationTarget' => 'required|numeric',
            'deadline' => 'required',
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
            $request->deadline,
            0,
            $oldDonation->created_at,
            0,
            $request->donationTarget,
            0,
            $request->assistedSubject,
            $request->bank,
            $request->accountNumber
        );
        // update data donasi
        $this->donation_service->updateDonation($donation, $id, $empty);
        // hapus detail allocation yang id-nya $id
        $this->donation_service->deleteAllocationDetail($id);
        // insert detail allocation yang baru
        for ($i = 0; $i < count($request->nominal); $i++) {
            $allocationDetail = new Model\DetailAllocation($id, $request->allocationFor[$i], $request->nominal[$i]);
            $this->donation_service->storeDetailAllocation($allocationDetail);
        }

        return redirect('/donation/edit/' . $id)->with(['type' => "success", 'message' => 'Event Anda berhasil diperbarui.']);
    }
}
