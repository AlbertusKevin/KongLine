<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use \App\Domain\Event\Entity\User;
use \App\Domain\Communication\Entity\Service;

class ServiceController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        if (auth()->user()->role == 'admin') {
            $messages = Service::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        }

        return view('service/home', [
            'users' => $users,
            'messages' => $messages ?? null
        ]);
    }

    public function show($id)
    {
        if (auth()->user()->role != 'admin') {
            abort(404);
        }

        $sender = User::findOrFail($id);

        $users = User::with(['message' => function ($query) {
            return $query->orderBy('created_at', 'DESC');
        }])->orderBy('id', 'DESC')->get();

        if (auth()->user()->role != 'admin') {
            $messages = Service::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        } else {
            $messages = Service::where('user_id', $sender)->orWhere('receiver', $sender)->orderBy('id', 'DESC')->get();
        }

        return view('service/show', [
            'users' => $users,
            'messages' => $messages,
            'sender' => $sender,
        ]);
    }
}
