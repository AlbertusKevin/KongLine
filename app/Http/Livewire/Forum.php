<?php

namespace App\Http\Livewire;

use App\Domain\Communication\Service\CommunicationService;
use Livewire\Component;

class Forum extends Component
{
    public $forum;
    public $idForum;
    private $service;

    public function __construct()
    {
        $this->service = new CommunicationService();
    }

    public function render()
    {
        return view('livewire.forum', [
            'forum' => $this->forum
        ]);
    }

    public function mount(){
        $this->forum = $this->service->findAllForum();
    }

    public function like()
    {
        $like = $this->service->newLike();
        $like->idForum = $this->idForum;
        $like->idParticipant = auth()->id();
        $this->service->saveLike($like);
    }

    public function unlike()
    {
        $like = $this->service->findLikeBy($this->idForum, auth()->id());
        $like->delete();
    }

    public function getIdForum($idForum)
    {
        $this->idForum = $idForum;
    }
}
