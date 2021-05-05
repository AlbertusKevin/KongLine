<?php

namespace App\Http\Controllers;

use App\Domain\Communication\Entity\Forum;
use App\Domain\Communication\Service\CommunicationService;
use App\Domain\Event\Service\EventService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ForumController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new CommunicationService();
    }

    public function index()
    {
        $forum = $this->service->findAllForum();
        $navbar = EventService::getNavbar();

        return view('forum.forum', [
            'forum' => $forum,
            'navbar' => $navbar
        ]);
    }

    public function comment($id)
    {
        $forum = $this->service->findForumbyId($id);
        $navbar = EventService::getNavbar();
        return view('forum.comment', [
            'forum' => $forum,
            'navbar' => $navbar,
        ]);
    }

    public function error()
    {
        session()->flash('message', 'Silahkan Login ');

        return redirect()->back();
    }

    public function inputforum()
    {
        $navbar = EventService::getNavbar();
        return view('forum.inputforum', compact('navbar'));
    }

    public function input(Request $req)
    {
        $forum = new Forum();
        $forum->idParticipant = auth()->id();
        $forum->title = $req->judul;
        $forum->content = $req->diskusi;
        $forum->created_at = Carbon::now();
        $forum->save();

        Session::flash('success', 'Diskusi berhasil dibuat');
        return redirect('/forum');
    }
}
