<?php

namespace App\Http\Controllers;

use App\Domain\Event\Model;
use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
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
    public function indexPetition(Request $request)
    {
        $user = $this->eventService->showProfile();
        $listCategory = $this->eventService->listCategory();
        $petitionList = $this->eventService->indexPetition();
        return view('petition.petition', compact('petitionList', 'user', 'listCategory'));
    }

    //! {{-- lewat ajax --}} Menampilkan daftar petisi berdasarkan tipe (berlangsung, telah menang, dll)
    public function listPetitionType(Request $request)
    {
        return $this->eventService->listPetitionType($request);
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
        $user = $this->eventService->showProfile();
        $petition = $this->eventService->showPetition($idEvent);
        $isParticipated = $this->eventService->checkParticipated($idEvent, $user, PETITION);
        $message = $this->eventService->messageOfEvent($petition->status);

        return view('petition.petitionDetail', compact('petition', 'user', 'isParticipated', 'message'));
    }

    //! Menampilkan seluruh komentar pada petisi tertentu sesuai ID Petisi
    public function commentPetition($idEvent)
    {
        $petition = $this->eventService->showPetition($idEvent);
        $comments = $this->eventService->commentsPetition($idEvent);

        return view('petition.petitionComment', compact('petition', 'comments'));
    }

    //! Menampilkan seluruh berita perkembangan petisi tertentu sesuai ID Petisi
    public function progressPetition($idEvent)
    {
        $petition = $this->eventService->showPetition($idEvent);
        $news = $this->eventService->newsPetition($idEvent);
        $user = $this->eventService->showProfile();

        return view('petition.petitionProgress', compact('petition', 'news', 'user'));
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
        $user = $this->eventService->showProfile();
        $this->eventService->signPetition($request, $idEvent, $user);

        return redirect("/petition/" . $idEvent)->with(['type' => "success", 'message' => 'Berhasil Menandatangai petisi ini. Terimakasih ikut berpartisipasi!']);
    }

    //! Menampilkan halaman form untuk membuat petisi
    public function createPetition()
    {
        $user = $this->eventService->showProfile();
        $listCategory = $this->eventService->listCategory();
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

        $user = $this->eventService->showProfile();
        $petition = new Model\Petition($user->id, $request->title, $request->file('photo'), $request->category, $request->purpose, $request->deadline, 0, Carbon::now()->format('Y-m-d'), $request->signedTarget, 0, $request->targetPerson);
        $this->eventService->storePetition($petition);

        return redirect('/petition')->with(['type' => "success", 'message' => 'Petisi Anda telah didaftarkan. Tunggu konfirmasi dari admin.']);
    }

    //* =========================================================================================
    //* ----------------------------------- Controller Donasi -----------------------------------
    //* =========================================================================================
    public function listDonation()
    {
        $donations = $this->eventService->getListDonation();
        $categories = $this->eventService->listCategory();
        $user = $this->eventService->showProfile();

        return view('donation.donation', compact('donations', 'categories', 'user'));
    }

    public function getADonation($id)
    {
        $donation = $this->eventService->getADonation($id); // detail donasi mencakup siapa pembuat event itu
        $user = $this->eventService->showProfile();
        $progress = $this->eventService->countProgressDonation($donation); // untuk progress bar
        $category = $this->eventService->getACategory($donation->category); // untuk menampilkan kategori
        $participatedDonation = $this->eventService->getParticipatedDonation($id); // untuk tab donatur dan comment
        $alocationBudget = $this->eventService->getABudgetingDonation($id); // untuk tab alokasi dana
        $isParticipated = $this->eventService->checkParticipated($id, $user, DONATION); // untuk pengecekan apakah pernah donasi atau tidak
        $message = $this->eventService->messageOfEvent($donation->status); // Menampilkan pesan status sebuah event
        // pengecekan, apakah donasi di event ini sudah dikonfirmasi pembayaran oleh user
        $userTransactionStatus = $this->eventService->checkUserTransactionStatus($participatedDonation, $user->id);
        $allStatusZero = $this->eventService->checkStatusIsZero($participatedDonation);

        // dd($userTransactionStatus);
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
                'allStatusZero'
            )
        );
    }

    public function formDonate($id)
    {
        $user = $this->eventService->showProfile();
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

        $user = $this->eventService->showProfile();
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
        $user = $this->eventService->showProfile();
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
        $user = $this->eventService->showProfile();
        $listCategory = $this->eventService->listCategory();
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

        $user = $this->eventService->showProfile();

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
}
