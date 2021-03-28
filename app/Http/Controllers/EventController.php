<?php

namespace App\Http\Controllers;

use App\Domain\Event\Model;
use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
            Alert::error('Gagal Menyimpan Perubahan', [$messageError]);
            return redirect('/petition/progress/' . $idEvent);
        };

        $updateNews = new Model\UpdateNews($idEvent, $request->title, $request->content, $request->link, $request->file('image'), Carbon::now()->format('Y-m-d'));
        $this->eventService->storeProgressPetition($updateNews);

        Alert::success('Berhasil', 'Perkembangan terbaru dari petisi ini berhasil ditambahkan!');
        return redirect('/petition/progress/' . $idEvent);
    }

    //! Memproses tandatangan peserta pada petisi tertentu
    public function signPetition(Request $request, $idEvent)
    {
        $user = $this->eventService->showProfile();
        $this->eventService->signPetition($request, $idEvent, $user);
        Alert::success('Berhasil Menandatangai petisi ini.', 'Terimakasih ikut berpartisipasi!');
        return redirect("/petition/" . $idEvent);
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

            Alert::error('Gagal Mendaftarkan Petisi', [$messageError]);
            return redirect('/petition/create');
        };

        $user = $this->eventService->showProfile();
        $petition = new Model\Petition($user->id, $request->title, $request->file('photo'), $request->category, $request->purpose, $request->deadline, 0, Carbon::now()->format('Y-m-d'), $request->signedTarget, 0, $request->targetPerson);
        $this->eventService->storePetition($petition);

        Alert::success('Berhasil', 'Petisi Anda telah didaftarkan. Tunggu konfirmasi dari admin.');
        return redirect('/petition');
    }

    //* =========================================================================================
    //* ----------------------------------- Controller Donasi -----------------------------------
    //* =========================================================================================
    public function listDonation()
    {
        $donations = $this->eventService->getListDonation();
        $categories = $this->eventService->listCategory();
        $user = $this->eventService->showProfile();

        return view('donation', compact('donations', 'categories', 'user'));
    }

    public function getADonation($id)
    {
        $donation = $this->eventService->getADonation($id);
        $user = $this->eventService->showProfile();
        $progress = $this->eventService->countProgressDonation($donation); // untuk progress bar
        $category = $this->eventService->getACategory($donation->category); // untuk menampilkan deskripsi kategori
        $participatedDonation = $this->eventService->getParticipatedDonation($id); // untuk tab donatur
        $alocationBudget = $this->eventService->getABudgetingDonation($id); // untuk tab alokasi dana
        $isParticipated = $this->eventService->checkParticipated($id, $user, DONATION); // untuk pengecekan apakah pernah donasi atau tidak
        $message = $this->eventService->messageOfEvent($donation->status);
        $userTransactionStatus = $this->eventService->checkUserTransactionStatus($participatedDonation, $user->id);

        return view(
            'donationDetail',
            compact(
                'donation',
                'user',
                'progress',
                'category',
                'participatedDonation',
                'alocationBudget',
                'isParticipated',
                'message',
                'userTransactionStatus'
            )
        );
    }

    public function formDonate($id)
    {
        $user = $this->eventService->showProfile();
        $donation = $this->eventService->getADonation($id);
        return view('donateForm', compact('user', 'donation'));
    }

    public function postDonate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nominal' => 'required|numeric|min:10000',
            'comment' => 'nullable|min:20',
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            Alert::error('Gagal Berdonasi', [$messageError]);
            return redirect('/donation/donate/' . $id)->withInput();
        };

        $user = $this->eventService->showProfile();
        $annonymousComment = $this->eventService->checkAnnonym($request->annonymousComment);
        $annonymousDonate = $this->eventService->checkAnnonym($request->annonymousDonatur);

        $participateDonation = new Model\ParticipateDonation($id, $user->id, $request->comment, Carbon::now()->format('Y-m-d'), $annonymousComment);
        $transaction = new Model\Transaction($id, $user->id, $user->accountNumber, $request->nominal, $annonymousDonate, 0, Carbon::now()->format("Y-m-d"));
        $this->eventService->postDonate($participateDonation);
        $this->eventService->postTransaction($transaction);

        Alert::success('Berhasil', 'Donasi Anda telah ditambahkan. Lanjutkan ke konfirmasi pembayaran.');
        return redirect('/donation/confirm_donate/' . $id);
    }

    public function formConfirm($id)
    {
        $donation = $this->eventService->getADonation($id);
        $user = $this->eventService->showProfile();
        $transaction = $this->eventService->getAUserTransaction($user->id);

        return view('donateConfirm', compact('donation', 'user', 'transaction'));
    }

    public function postConfirm(Request $request, $id)
    {
        dd("post confirm");
    }

    public function createView()
    {
        dd("Hello World");
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