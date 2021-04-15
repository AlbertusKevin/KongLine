<?php

namespace App\Http\Livewire;

use App\Domain\Admin\Entity\CommentForum;
use App\Domain\Communication\Entity\Forum;
use App\Domain\Communication\Service\CommunicationService;
use Livewire\Component;

class Comment extends Component
{
    public $forum;
    public $idParticipant;
    public $comment;
    private $service;

    public function __construct()
    {
        $this->service = new CommunicationService();
    }

    public function render()
    {
        return view('livewire.comment', [
            'forum' => $this->forum
        ]);
    }

    public function mount()
    {
        $this->forum = $this->service->findForumbyId($this->forum->id);
    }

    public function SendComment(){
        $comment = $this->service->newComment();
        $comment->idForum = $this->forum->id;
        $comment->idParticipant = auth()->id();
        $comment->content = $this->comment;
        $this->service->saveComment($comment);
    }

    public function getUser($idParticipant)
    {
        $this->idParticipant = 5;
    }
}
