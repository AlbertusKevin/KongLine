<?php

namespace App\Http\Controllers;

use App\Domain\Event\Model;
use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DonationController extends Controller
{
    private $eventService;

    public function __construct()
    {
        $this->eventService = new EventService();
    }

    //* =========================================================================================
    //* ----------------------------------- Controller Petisi -----------------------------------
    //* =========================================================================================
    //! Menampilkan seluruh petisi yang sedang berlangsung
    public function getAllActivePetition(Request $request)
    {
        $user = $this->eventService->getAProfile();
        $listCategory = $this->eventService->getAllCategoriesEvent();
        $petitionList = $this->eventService->getAllActivePetition();
        $navbar = EventService::getNavbar();

        return view('petition.petition', compact('petitionList', 'user', 'listCategory', 'navbar'));
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi berdasarkan tipe (berlangsung, telah menang, dll)
    public function listPetitionType(Request $request)
    {
        return $this->eventService->listPetitionType($request);
    }

    public function getAllCategory()
    {
        return $this->eventService->getAllCategoriesEvent();
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai keyword yang diketik
    public function searchPetition(Request $request)
    {
        return $this->eventService->searchPetition($request);
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function sortPetition(Request $request)
    {
        return $this->eventService->sortPetition($request);
    }

    //! Menampilkan detail petisi sesuai ID Petisi
    public function showPetition(Request $request, $idEvent)
    {
        $user = $this->eventService->getAProfile();
        $petition = $this->eventService->showPetition($idEvent);
        $isParticipated = $this->eventService->checkParticipated($idEvent, $user, PETITION);
        $message = $this->eventService->messageOfEvent($petition->status);
        $navbar = EventService::getNavbar();

        return view('petition.petitionDetail', compact('petition', 'user', 'isParticipated', 'message', 'navbar'));
    }

    //! Menampilkan seluruh komentar pada petisi tertentu sesuai ID Petisi
    public function commentPetition($idEvent)
    {
        $user = $this->eventService->getAProfile();
        $petition = $this->eventService->showPetition($idEvent);
        $comments = $this->eventService->commentsPetition($idEvent);
        $navbar = EventService::getNavbar();

        return view('petition.petitionComment', compact('petition', 'comments', 'navbar', 'user'));
    }

    //! Menampilkan seluruh berita perkembangan petisi tertentu sesuai ID Petisi
    public function progressPetition($idEvent)
    {
        $petition = $this->eventService->showPetition($idEvent);
        $news = $this->eventService->newsPetition($idEvent);
        $user = $this->eventService->getAProfile();
        $navbar = EventService::getNavbar();

        return view('petition.petitionProgress', compact('petition', 'news', 'user', 'navbar'));
    }

    //! Menyimpan perkembangan berita terbaru yang diinput oleh pengguna pada petisi tertentu
    public function storeProgressPetition(Request $request, $idEvent)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required|min:300',
            'image' => 'image',
            'link' => 'active_url|nullable'
        ]);

        if ($validator->fails()) {
            $messageError = [];
            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }
            // Alert::error('Gagal Menyimpan Perubahan', [$messageError]);
            return redirect('/petition/progress/' . $idEvent)->with(['type' => "error", 'message' => $messageError]);
        };

        $updateNews = new Model\UpdateNews($idEvent, $request->title, $request->content, $request->link, $request->file('image'), Carbon::now()->format('Y-m-d'));
        $this->eventService->storeProgressPetition($updateNews);

        return redirect('/petition/progress/' . $idEvent)->with(['type' => "success", 'message' => 'Perkembangan terbaru dari petisi ini berhasil ditambahkan!']);
    }

    //! Memproses tandatangan peserta pada petisi tertentu
    public function signPetition(Request $request, $idEvent)
    {
        $user = $this->eventService->getAProfile();
        $this->eventService->signPetition($request, $idEvent, $user);

        return redirect("/petition/" . $idEvent)->with(['type' => "success", 'message' => 'Berhasil Menandatangai petisi ini. Terimakasih ikut berpartisipasi!']);
    }

    //! Menampilkan halaman form untuk membuat petisi
    public function createPetition()
    {
        $user = $this->eventService->getAProfile();
        $listCategory = $this->eventService->getAllCategoriesEvent();
        return view('petition.petitionCreate', compact('user', 'listCategory'));
    }

    //! Mengecek verifikasi data diri yang diberikan sebelum membuat event
    public function verifyProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'numeric|nullable'
        ]);

        if ($validator->fails()) {
            return json_encode("Validation Error");
        };

        return json_encode($this->eventService->verifyProfile($request->email, $request->phone));
    }

    //! Menyimpan data petisi ke database
    public function storePetition(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'photo' => 'required|image',
            'signedTarget' => 'required|numeric',
            'deadline' => 'date|required',
            'purpose' => 'required|min:300',
            'targetPerson' => 'required'
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/petition/create')->withInput()->with(['type' => "error", 'message' => 'Gagal Mendaftarkan petisi' . $messageError]);
        };

        $user = $this->eventService->getAProfile();
        $petition = new Model\Petition($user->id, $request->title, $request->file('photo'), $request->category, $request->purpose, $request->deadline, 0, Carbon::now()->format('Y-m-d'), $request->signedTarget, 0, $request->targetPerson);
        $this->eventService->storePetition($petition);

        return redirect('/petition')->with(['type' => "success", 'message' => 'Petisi Anda telah didaftarkan. Tunggu konfirmasi dari admin.']);
    }

    //! Menampilkan halaman form untuk update petisi
    public function editPetition($id)
    {
        $user = $this->eventService->getAProfile();
        $listCategory = $this->eventService->getAllCategoriesEvent();
        $petition = $this->eventService->showPetition($id);

        return view('petition.petitionEdit', compact('user', 'listCategory', 'petition'));
    }

    public function updatePetition(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'photo' => 'image',
            'signedTarget' => 'required|numeric',
            'deadline' => 'date|required',
            'purpose' => 'required|min:300',
            'targetPerson' => 'required'
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/petition/edit/' . $id)->withInput()->with(['type' => "error", 'message' => 'Gagal Memperbarui petisi' . $messageError]);
        };

        $user = $this->eventService->getAProfile();
        $oldPetition = $this->eventService->showPetition($id);
        $file = $oldPetition->photo;
        $empty = true;

        // jika file ingin diperbarui
        if (!empty($request->file())) {
            $file = $request->file('photo');
            $empty = false;
        }

        $petition = new Model\Petition($user->id, $request->title, $file, $request->category, $request->purpose, $request->deadline, 0, $oldPetition->created_at, $request->signedTarget, 0, $request->targetPerson);
        $this->eventService->updatePetition($petition, $id, $empty);

        return redirect('/petition/edit/' . $id)->with(['type' => "success", 'message' => 'Petisi Anda berhasil diperbarui.']);
    }

    //* =========================================================================================
    //* ----------------------------------- Controller Donasi -----------------------------------
    //* =========================================================================================
    public function listDonation()
    {
        $donations = $this->eventService->getListDonation();
        $categories = $this->eventService->getAllCategoriesEvent();
        $user = $this->eventService->getAProfile();
        $navbar = EventService::getNavbar();


        return view('donation.donation', compact('donations', 'categories', 'user', 'navbar'));
    }

    public function getADonation($id)
    {
        $donation = $this->eventService->getADonation($id); // detail donasi mencakup siapa pembuat event itu
        $user = $this->eventService->getAProfile();
        $progress = $this->eventService->countProgressDonation($donation); // untuk progress bar
        $category = $this->eventService->getACategory($donation->category); // untuk menampilkan kategori
        $participatedDonation = $this->eventService->getParticipatedDonation($id); // untuk tab donatur dan comment
        $alocationBudget = $this->eventService->getABudgetingDonation($id); // untuk tab alokasi dana
        $isParticipated = $this->eventService->checkParticipated($id, $user, DONATION); // untuk pengecekan apakah pernah donasi atau tidak
        $message = $this->eventService->messageOfEvent($donation->status); // Menampilkan pesan status sebuah event
        // pengecekan, apakah donasi di event ini sudah dikonfirmasi pembayaran oleh user
        $userTransactionStatus = $this->eventService->checkUserTransactionStatus($participatedDonation, $user->id);
        $allStatusZero = $this->eventService->checkStatusIsZero($participatedDonation);
        $navbar = EventService::getNavbar();

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
        $user = $this->eventService->getAProfile();
        $donation = $this->eventService->getADonation($id);
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

        $user = $this->eventService->getAProfile();
        $annonymousComment = $this->eventService->checkAnnonym($request->annonymousComment);
        $annonymousDonate = $this->eventService->checkAnnonym($request->annonymousDonatur);

        $participateDonation = new Model\ParticipateDonation($id, $user->id, $request->comment, Carbon::now()->format('Y-m-d'), $annonymousComment);
        $transaction = new Model\Transaction($id, $user->id, $request->rekeningUser, $request->nominal, $annonymousDonate, 0, Carbon::now()->format("Y-m-d"));
        $this->eventService->postDonate($participateDonation);
        $this->eventService->postTransaction($transaction);

        return redirect('/donation/confirm_donate/' . $id)->with(['type' => "success", 'message' => 'Donasi Anda telah ditambahkan. Lanjutkan ke konfirmasi pembayaran.']);
    }

    public function formConfirm($id)
    {
        $donation = $this->eventService->getADonation($id);
        $user = $this->eventService->getAProfile();
        $transaction = $this->eventService->getAUserTransaction($user->id, $id);
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

        $this->eventService->confirmationPictureDonation($request->file('repaymentPicture'), $id);

        return redirect('/donation/' . $id)->with(['type' => "success", 'message' => 'Konfirmasi pembayaran akan segera diproses']);
    }

    public function createView()
    {
        $user = $this->eventService->getAProfile();
        $listCategory = $this->eventService->getAllCategoriesEvent();
        $listBank = $this->eventService->listBank();

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

        $user = $this->eventService->getAProfile();

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

        $this->eventService->storeDonationCreated($donation);
        $idDonation = $this->eventService->getLastIdDonation()->id;

        for ($i = 0; $i < count($request->nominal); $i++) {
            $allocationDetail = new Model\DetailAllocation($idDonation, $request->allocationFor[$i], $request->nominal[$i]);
            $this->eventService->storeDetailAllocation($allocationDetail);
        }

        return redirect('/donation')->with(['type' => "success", 'message' => 'Event Anda sudah didaftarkan. Tunggu konfirmasi dari admin.']);
    }

    public function editDonate($id)
    {
        $user = $this->eventService->getAProfile();
        $donation = $this->eventService->getADonation($id);
        $transaction = $this->eventService->getAUserTransaction($user->id, $id);

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
            $this->eventService->confirmationPictureDonation($request->file('repaymentPicture'), $id);
        } else {
            $this->eventService->updateTransactionDonation($id);
        }

        return redirect('/donation/' . $id)->with(['type' => "success", 'message' => 'Konfirmasi pembayaran akan segera diproses']);
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai keyword yang diketik
    public function searchDonation(Request $request)
    {
        return $this->eventService->searchDonation($request);
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi sesuai urutan dan kategori yang dipilih
    public function sortDonation(Request $request)
    {
        return $this->eventService->sortDonation($request);
    }

    public function editDonation($id)
    {
        $user = $this->eventService->getAProfile();
        $donation = $this->eventService->getADonation($id);
        $listCategory = $this->eventService->getAllCategoriesEvent();
        $listBank = $this->eventService->listBank();
        $detailAllocation = $this->eventService->getDetailAllocation($id);
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

        $user = $this->eventService->getAProfile();
        $oldDonation = $this->eventService->getADonation($id);
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
        $this->eventService->updateDonation($donation, $id, $empty);
        // hapus detail allocation yang id-nya $id
        $this->eventService->deleteAllocationDetail($id);
        // insert detail allocation yang baru
        for ($i = 0; $i < count($request->nominal); $i++) {
            $allocationDetail = new Model\DetailAllocation($id, $request->allocationFor[$i], $request->nominal[$i]);
            $this->eventService->storeDetailAllocation($allocationDetail);
        }

        return redirect('/donation/edit/' . $id)->with(['type' => "success", 'message' => 'Event Anda berhasil diperbarui.']);
    }
}
