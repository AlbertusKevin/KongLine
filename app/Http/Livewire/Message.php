<?php

namespace App\Http\Livewire;

use \App\Domain\Event\Entity\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Message extends Component
{

    public $message;
    public $users;
    public $clicked_user;
    public $messages;
    public $admin;

    public function render()
    {

        return view('livewire.message', [
            'users' => $this->users,
            'admin' => $this->admin
        ]);
    }

    public function mount() {
        if (auth()->user()->role != 'admin') {
            $this->messages = \App\Domain\Communication\Entity\Service::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        } else {
            $this->messages = \App\Domain\Communication\Entity\Service::where('user_id', $this->clicked_user)->orWhere('receiver', $this->clicked_user)->orderBy('id', 'DESC')->get();
        }
        $this->admin = \App\Domain\Event\Entity\User::where('role', 'admin')->first();
    }

    public function SendMessage() {
        $new_message = new \App\Domain\Communication\Entity\Service();
        $new_message->message = $this->message;
        $new_message->user_id = auth()->id();
        if (!auth()->user()->role == 'admin') {
            $admin = User::where('role', 'admin')->first();
            $this->user_id = $admin->id;
        } else {
            $this->user_id = $this->clicked_user->id;
        }
        $new_message->receiver = $this->user_id;
        $new_message->save();
    }

    public function getUser($user_id) {
        $this->clicked_user = User::find($user_id);
        $this->messages = \App\Domain\Communication\Entity\Service::where('user_id', $user_id)->get();
    }

}
