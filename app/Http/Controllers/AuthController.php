<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Carbon;
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

        // if ($validator->fails()) {
        //     return redirect('/register')
        //         ->withInput()
        //         ->withErrors($validator);
        // }

        $svc = new EventService();
        $result = $svc->authRegis($request);

        if($result){
            Alert::success('Register Success', 'Please Login.');
            return redirect('login');
        }{
            Alert::error('Register Gagal', 'Mohon cek kembali data Anda');
            return redirect('/register')
                ->withInput();
        }

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
                ->withErrors($validator);
        };

        $svc = new EventService();
        $result = $svc->authLogin($request);

        if ($result) {
            // dd(Auth::user()->status);
            if(Auth::user()->status == 1 || Auth::user()->status == 3){
                // dd("yooo");
                return redirect('/home');
            }

            Alert::error('Akun tidak ditemukan', 'Silahkan coba lagi');
            return view('auth.login');
            // dd(Auth::user()->status == 1 || Auth::user()->status == 3);
        }

        Alert::error('Email atau password salah', 'Silahkan coba lagi');
        return redirect('/login');

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

    public function postForgot(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $view = 'auth.verify';
        $subject = 'Reset Password';

        $svc = new EventService();
        $result = $svc->authForgot($request, $view, $subject);

        Alert::toast('Silahkan cek email Anda');
        return back();


    }

    public function getReset($email, $token){
        return view('auth.reset', ['token' => $token , 'email' => $email]);
    }

    public function postReset(Request $request){

        $svc = new EventService();
        $result = $svc->authReset($request);

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|required_with:passwordConfirm|same:passwordConfirm',
            'passwordConfirm' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        if($result){
            return redirect('/login')->with('message', 'Your password has been changed!');
        }else{
            Alert::toast('Gagal ganti password, silahkan coba lagi');
            return back();
        }

    }
}
