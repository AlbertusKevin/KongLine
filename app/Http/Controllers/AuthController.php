<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function postRegister(Request $request){
        $validator = Validator::make($request-> all(), [
            'firstname' => 'required|min:4',
            'lastname' => 'min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

        ]);

        if($validator->fails()) {
            return redirect('/register')
                ->withInput()
                ->withErrors($validator);
        }
        $role = "participant";
        $status = 1;
        $photo = "images/profile/photo/default.svg";

        $data = new User();
        $data->name=$request->firstname . ' ' . $request->lastname;
        $data->email=$request->email;
        $data->status=$status;
        $data->role=$role;
        $data->photoProfile=$photo;

        if($request->password){
            $data->password=Hash::make($request->password);
        }
        $data->save();

        Alert::success('Register Success','Please Login.');
        return redirect('login');

    }

    public function getLogin(){
        return view('auth.login');
    }

    public function getRegister(){
        return view('auth.register');
    }

}
