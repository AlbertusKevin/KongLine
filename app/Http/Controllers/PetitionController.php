<?php

namespace App\Http\Controllers;

use App\Domain\Petition\Model;
use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;
use App\Domain\Petition\Service\PetitionService;
use App\Domain\Profile\Service\ProfileService;
use App\Domain\Helper\HelperService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PetitionController extends Controller
{
    private $petition_service;
    private $profile_service;
    private $event_service;

    public function __construct()
    {
        $this->petition_service = new PetitionService();
        $this->profile_service = new ProfileService();
        $this->event_service = new EventService();
    }

    //! Menampilkan seluruh petisi yang sedang berlangsung
    public function getActivePetition(Request $request)
    {
        $this->petition_service->deadlinePetition();
        $user = $this->profile_service->getAProfile();
        $listCategory = $this->event_service->getAllCategoriesEvent();
        $petitionList = $this->petition_service->getActivePetition();
        $navbar = HelperService::getNavbar();

        return view('petition.petition', compact('petitionList', 'user', 'listCategory', 'navbar'));
    }

    //! Request dengan ajax menampilkan petisi berdasarkan sort, search, type, dan category
    public function getListPetitionByStatus(Request $request)
    {
        return $this->petition_service->getListPetitionByStatus($request);
    }

    public function searchPetition(Request $request)
    {
        return $this->petition_service->searchPetition($request);
    }

    public function sortPetition(Request $request)
    {
        return $this->petition_service->sortPetition($request);
    }

    //! Menampilkan detail petisi sesuai ID Petisi
    public function getDetailPetition(Request $request, $idEvent)
    {
        $this->petition_service->deadlinePetition();
        $user = $this->profile_service->getAProfile();
        $petition = $this->petition_service->getDetailPetition($idEvent);
        $isParticipated = $this->event_service->checkParticipated($idEvent, $user->id, PETITION);
        $message = $this->event_service->messageOfEvent($petition->status);
        $navbar = HelperService::getNavbar();

        return view('petition.petitionDetail', compact('petition', 'user', 'isParticipated', 'message', 'navbar'));
    }

    //! Menampilkan seluruh komentar pada petisi tertentu sesuai ID Petisi
    public function getCommentsCertainPetition($idEvent)
    {
        $user = $this->profile_service->getAProfile();
        $petition = $this->petition_service->getDetailPetition($idEvent);
        $comments = $this->petition_service->getCommentsCertainPetition($idEvent);
        $navbar = HelperService::getNavbar();

        return view('petition.petitionComment', compact('petition', 'comments', 'navbar', 'user'));
    }

    //! Menampilkan seluruh berita perkembangan petisi tertentu sesuai ID Petisi
    public function getProgressCertainPetition($idEvent)
    {
        $petition = $this->petition_service->getDetailPetition($idEvent);
        $news = $this->petition_service->getProgressCertainPetition($idEvent);
        $user = $this->profile_service->getAProfile();
        $navbar = HelperService::getNavbar();

        return view('petition.petitionProgress', compact('petition', 'news', 'user', 'navbar'));
    }

    //! Menyimpan perkembangan berita terbaru yang diinput oleh pengguna pada petisi tertentu
    public function saveProgressPetition(Request $request, $idEvent)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required|min:150',
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
        $this->petition_service->saveProgressPetition($updateNews);

        return redirect('/petition/progress/' . $idEvent)->with(['type' => "success", 'message' => 'Perkembangan terbaru dari petisi ini berhasil ditambahkan!']);
    }

    //! Memproses tandatangan peserta pada petisi tertentu
    public function signedThePetition(Request $request, $idEvent)
    {
        $user = $this->profile_service->getAProfile();
        $this->petition_service->signedThePetition($request, $idEvent, $user);

        return redirect("/petition/" . $idEvent)->with(['type' => "success", 'message' => 'Berhasil Menandatangai petisi ini. Terimakasih ikut berpartisipasi!']);
    }

    //! Create event petisi
    public function getViewCreatePetition()
    {
        $user = $this->profile_service->getAProfile();
        $listCategory = $this->event_service->getAllCategoriesEvent();
        return view('petition.petitionCreate', compact('user', 'listCategory'));
    }

    public function saveDataEventPetition(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'photo' => 'required|image',
            'purpose' => 'required|min:150',
            'targetPerson' => 'required'
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/petition/create')->withInput()->with(['type' => "error", 'message' => 'Gagal Mendaftarkan petisi' . $messageError]);
        };

        $user = $this->profile_service->getAProfile();
        $petition = new Model\Petition($user->id, $request->title, $request->file('photo'), $request->category, $request->purpose, 0, Carbon::now('+7:00'), Carbon::now('+7:00'), 0, $request->targetPerson);
        $this->petition_service->saveDataEventPetition($petition);

        return redirect('/petition')->with(['type' => "success", 'message' => 'Petisi Anda telah didaftarkan. Tunggu konfirmasi dari admin.']);
    }

    //! Update detail data suatu petisi
    public function getViewEditPetition($id)
    {
        $user = $this->profile_service->getAProfile();
        $listCategory = $this->event_service->getAllCategoriesEvent();
        $petition = $this->petition_service->getDetailPetition($id);

        return view('petition.petitionEdit', compact('user', 'listCategory', 'petition'));
    }

    public function updatePetition(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'photo' => 'image',
            'purpose' => 'required|min:150',
            'targetPerson' => 'required'
        ]);

        if ($validator->fails()) {
            $messageError = [];

            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/petition/edit/' . $id)->withInput()->with(['type' => "error", 'message' => 'Gagal Memperbarui petisi' . $messageError]);
        };

        $user = $this->profile_service->getAProfile();
        $oldPetition = $this->petition_service->getDetailPetition($id);
        $file = $oldPetition->photo;
        $empty = true;

        // jika file ingin diperbarui
        if (!empty($request->file())) {
            $file = $request->file('photo');
            $empty = false;
        }

        $petition = new Model\Petition($user->id, $request->title, $file, $request->category, $request->purpose, 0, $oldPetition->created_at, Carbon::now('+7:00'), 0, $request->targetPerson);
        $this->petition_service->updatePetition($petition, $id, $empty);

        return redirect('/petition/edit/' . $id)->with(['type' => "success", 'message' => 'Petisi Anda berhasil diperbarui.']);
    }
}
