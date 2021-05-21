<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Domain\Profile\Service\ProfileService;

class AuthController extends Controller
{
    private $profile_service;

    public function __construct()
    {
        $this->profile_service = new ProfileService();
    }

    public function getViewLogin()
    {
        return view('auth.login');
    }

    public function postDataLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                ->withInput()
                ->withErrors($validator)
                ->with(['type' => "error", 'message' => 'Login tidak berhasil. Pastikan input sudah tepat.']);
        };

        $result = $this->profile_service->authLogin($request);

        if ($result) {
            if (auth()->user()->role == 'admin') {
                return redirect('/admin');
            } elseif (Auth::user()->status == 1 || Auth::user()->status == 3) {
                return redirect('/home');
            } else {
                Auth::logout();
                return redirect('/login')->with(['type' => "error", 'message' => 'Akun tidak terdaftar']);
            }
        }

        return redirect('/login')->with(['type' => "error", 'message' => 'Email atau password salah. Silahkan coba lagi']);
    }

    public function getViewRegister()
    {
        return view('auth.register');
    }

    public function postDataRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|min:4',
            'lastname' => 'min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withInput()
                ->withErrors($validator)
                ->with(['type' => "error", 'message' => 'Nama minimal 4 karakter, password minimal 6, dan pastikan email belum pernah digunakan orang lain.']);
        }

        $this->profile_service->authRegis($request);
        return redirect('login')->with(['type' => "success", 'message' => 'Registrasi berhasil. Silahkan login.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function getViewForgotPassword()
    {
        return view('auth.forgot');
    }

    public function postDataForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);

        if ($validator->fails()) {
            return redirect('/forgot')
                ->withInput()
                ->withErrors($validator)
                ->with(['type' => "error", 'message' => 'Email kurang tepat. Pastikan format email benar dan terdaftar pada sistem.']);
        };

        $view = 'auth.verify';
        $subject = 'Reset Password';

        $this->profile_service->authForgotPassword($request, $view, $subject);

        Alert::toast('Silahkan cek email Anda');
        return back();
    }

    public function getViewResetPassword($email, $token)
    {
        return view('auth.reset', ['token' => $token, 'email' => $email]);
    }

    public function postResetPassword(Request $request)
    {
        $result = $this->profile_service->authReset($request);

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|required_with:passwordConfirm|same:passwordConfirm',
            'passwordConfirm' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        if ($result) {
            return redirect('/login')->with('message', 'Your password has been changed!');
        }

        Alert::toast('Gagal ganti password, silahkan coba lagi');
        return back();
    }
}
