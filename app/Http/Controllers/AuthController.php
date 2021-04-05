<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Domain\Event\Service\EventService;

class AuthController extends Controller
{
    private $eventService;

    public function __construct()
    {
        $this->eventService = new EventService();
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|min:4',
            'lastname' => 'min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            // Alert::error("Gagal Mendaftar", "Sepertinya input ada yang kurang tepat.");
            return redirect('/register')
                ->withInput()
                ->withErrors($validator)
                ->with(['type' => "error", 'message' => 'Sepertinya input ada yang kurang tepat.']);
        }

        $result = $this->eventService->authRegis($request);

        if ($result) {
            // Alert::success('Register Success', 'Please Login.');
            return redirect('login')->with(['type' => "success", 'message' => 'Registrasi berhasil. Silahkan login.']);
        }

        // Alert::error('Register Gagal', 'Mohon cek kembali data Anda');
        return redirect('/register')
            ->withInput()
            ->with(['type' => "error", 'message' => 'Register Gagal. Mohon cek kembali data Anda']);
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                ->withInput()
                ->withErrors($validator)
                ->with(['type' => "error", 'message' => 'Login tidak berhasil. Input kurang tepat.']);
        };

        $result = $this->eventService->authLogin($request);

        if ($result) {
            if (auth()->user()->role == 'admin') {
                return redirect('/admin');
            } elseif (Auth::user()->status == 1 || Auth::user()->status == 3) {
                return redirect('/home');
            }
        }

        // Alert::error('Email atau password salah', 'Silahkan coba lagi');
        return redirect('/login')->with(['type' => "error", 'message' => 'Email atau password salah. Silahkan coba lagi']);;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function getForgot()
    {
        return view('auth.forgot');
    }

    public function postForgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $view = 'auth.verify';
        $subject = 'Reset Password';

        $this->eventService->authForgot($request, $view, $subject);

        Alert::toast('Silahkan cek email Anda');
        return back();
    }

    public function getReset($email, $token)
    {
        return view('auth.reset', ['token' => $token, 'email' => $email]);
    }

    public function postReset(Request $request)
    {
        $result = $this->eventService->authReset($request);

        if ($result) {
            return redirect('/login')->with('message', 'Your password has been changed!');
        }

        Alert::toast('Gagal ganti password, silahkan coba lagi');
        return back();
    }
}
