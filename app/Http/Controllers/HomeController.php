<?php

namespace App\Http\Controllers;

use \App\Domain\Event\Entity\User;
use \App\Domain\Communication\Entity\Service;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        if (Auth::user()->role == 'admin') {
            $messages = Service::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        }

        return view('home', [
            'users' => $users,
            'messages' => $messages ?? null,
        ]);
    }
}
