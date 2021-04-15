<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Show extends Component
{
    public $users;
    public $messages;
    public $sender;
    public $message;
    public $not_seen;

    public function render()
    {
        return view('livewire.show', [
            'users' => $this->users,
            'messages' => $this->messages,
            'sender' => $this->sender
        ]);
    }

    public function mount() {
        if (auth()->user()->role != 'admin') {
            $this->messages = \App\Domain\Communication\Entity\Service::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        } else {
            $this->messages = \App\Domain\Communication\Entity\Service::where('user_id', $this->sender->id)->orWhere('receiver', $this->sender->id)->orderBy('id', 'DESC')->get();
        }
        $not_seen = \App\Domain\Communication\Entity\Service::where('user_id', $this->sender->id)->where('receiver', auth()->id());
        $not_seen->update(['is_seen' => true]);
    }

    public function SendMessage() {
        $new_message = new \App\Domain\Communication\Entity\Service();
        $new_message->message = $this->message;
        $new_message->user_id = auth()->id();
        $new_message->receiver = $this->sender->id;
        $new_message->save();
    }
}
