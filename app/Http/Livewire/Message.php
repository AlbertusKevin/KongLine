<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domain\Communication\Service\CommunicationService;

class Message extends Component
{
    public $message;
    public $users;
    public $clicked_user;
    public $messages;
    public $admin;
    private $service;

    public function __construct()
    {
        $this->service = new CommunicationService();
    }

    public function render()
    {

        return view('livewire.message', [
            'users' => $this->users,
            'admin' => $this->admin
        ]);
    }

    public function mount() {
        if(auth()->user() != null){
            if (auth()->user()->role != 'admin') {
                $this->messages = $this->service->findMessageReceiver(auth()->id());
            } else {
                $this->messages = $this->service->findMessageReceiver($this->clicked_user);
            }
            
            $this->admin = $this->service->findAdmin();
            
        }
    }

    public function SendMessage() {
        
        $new_message = $this->service->newMessage();
        $new_message->message = $this->message;
        $new_message->user_id = auth()->id();
        if (!auth()->user()->role == 'admin') {
            $admin = $this->service->findAdmin();
            $this->user_id = $admin->id;
        } else {
            if($this->clicked_user == null){
                $admin = $this->service->findAdmin();
                $this->user_id = $admin->id;
            }else{
                $this->user_id = $this->clicked_user->id;
            }
        }
        $new_message->receiver = $this->user_id;
        $this->service->saveService($new_message);

    }

    public function getUser($user_id) {
        $this->clicked_user = $this->service->findUserbyId($user_id);
        $this->messages = $this->service->userService($user_id);
    }
}
