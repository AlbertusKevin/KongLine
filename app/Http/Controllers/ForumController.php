<?php

namespace App\Http\Controllers;

use App\Domain\Communication\Entity\Forum;
use App\Domain\Admin\Entity\CommentForum;
use App\Domain\Communication\Service\CommunicationService;
use Illuminate\Http\Request;

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
}
