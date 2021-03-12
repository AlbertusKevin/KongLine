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
        $user = $this->eventService->showProfile();
        $petition = new Model\Petition(2);

        dd($petition);
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
        $petition = $this->eventService->showPetition($idEvent);
        $user = $this->eventService->showProfile();
        if ($user->role != "guest") {
            $isParticipated = $this->eventService->checkParticipated($idEvent, $user->id, 'petition');
        } else {
            $isParticipated = false;
        }

        return view('petition.petitionDetail', compact('petition', 'user', 'isParticipated'));
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
