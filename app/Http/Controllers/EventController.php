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

    public function indexPetition(Request $request)
    {
        $user = $this->eventService->showProfile();
        $listCategory = $this->eventService->listCategory();
        $petitionList = $this->eventService->indexPetition();
        return view('petition.petition', compact('petitionList', 'user', 'listCategory'));
    }

    public function createPetition()
    {
        $user = $this->eventService->showProfile();
        $listCategory = $this->eventService->listCategory();
        return view('petition.petitionCreate', compact('user', 'listCategory'));
    }

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

    public function listPetitionType(Request $request)
    {
        return $this->eventService->listPetitionType($request);
    }

    public function searchPetition(Request $request)
    {
        return $this->eventService->searchPetition($request);
    }

    public function sortPetition(Request $request)
    {
        return $this->eventService->sortPetition($request);
    }

    public function showPetition(Request $request, $idEvent)
    {
        $user = $this->eventService->showProfile();
        $petition = $this->eventService->showPetition($idEvent);

        if ($user->role != "guest") {
            $isParticipated = $this->eventService->checkParticipated($idEvent, $user->id, 'petition');
        } else {
            $isParticipated = false;
        }

        if ($petition->status == 0) {
            $message = [
                'header' => 'Menunggu Konfirmasi',
                'content' => 'Event ini sudah didaftarkan. Tunggu konfirmasi dari pihak admin.'
            ];
        } else if ($petition->status == 2) {
            $message = [
                'header' => 'Telah Selesai',
                'content' => 'Event ini sudah selesai. Tidak menerima tandatangan lagi.'
            ];
        } else if ($petition->status == 3) {
            $message = [
                'header' => 'Sudah Ditutup',
                'content' => 'Event ini telah ditutup oleh penyelenggara / admin.'
            ];
        } else {
            $message = [
                'header' => 'Dibatalkan',
                'content' => 'Event ini dibatalkan oleh penyelenggara.'
            ];
        }

        return view('petition.petitionDetail', compact('petition', 'user', 'isParticipated', 'message'));
    }

    public function commentPetition($idEvent)
    {
        $petition = $this->eventService->showPetition($idEvent);
        $comments = $this->eventService->commentsPetition($idEvent);

        return view('petition.petitionComment', compact('petition', 'comments'));
    }

    public function progressPetition($idEvent)
    {
        $petition = $this->eventService->showPetition($idEvent);
        $news = $this->eventService->newsPetition($idEvent);
        $user = $this->eventService->showProfile();

        return view('petition.petitionProgress', compact('petition', 'news', 'user'));
    }
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

    public function signPetition(Request $request, $idEvent)
    {
        $user = Auth::user();
        $this->eventService->signPetition($request, $idEvent, $user);
        Alert::success('Berhasil Menandatangai petisi ini.', 'Terimakasih ikut berpartisipasi!');
        return redirect("/petition/" . $idEvent);
    }
}
