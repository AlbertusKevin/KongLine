<?php

namespace App\Http\Controllers;

use App\Domain\Communication\Entity\Forum;
use App\Domain\Admin\Entity\CommentForum;
use App\Domain\Communication\Service\CommunicationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

        return view('forum.forum', [
            'forum' => $forum,
        ]);
    }

    public function comment($id)
    {
        $forum = $this->service->findForumbyId($id);

        return view('forum.comment', [
            'forum' => $forum,
        ]);
    }

    public function error()
    {
        session()->flash('message', 'Silahkan Login ');

        return redirect()->back();
    }

    public function inputforum()
    {
        return view('forum.inputforum');
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

