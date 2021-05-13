<?php

namespace App\Domain\Profile\Dao;

use App\Domain\Profile\Entity\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ProfileDao
{
    //* =========================================================================================
    //* --------------------------------------- DAO Profile ----------------------------------------
    //* =========================================================================================
    public function updateCountEventParticipatedByUser($idUser, $count)
    {
        User::where('id', $idUser)->update([
            'countEvent' => $count
        ]);
    }

    //! Mengambil data user berdasarkan id
    public function getAProfile($id)
    {
        return User::where('id', $id)->first();
    }

    public function getUsers()
    {
        return User::orderBy('id', 'DESC')->get();
    }

    //! Memproses update data profile
    public function updateProfile($request, $id, $pathProfile, $pathBackground)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'aboutMe' => $request->aboutMe,
            'city' => $request->city,
            'linkProfile' => $request->linkProfile,
            'address' => $request->address,
            'zipCode' => $request->zipCode,
            'phoneNumber' => $request->phoneNumber,
            'photoProfile' => $pathProfile,
            'backgroundPicture' => $pathBackground
        ]);
    }

    public function deleteAccount($id)
    {
        User::where('id', $id)->update([
            'status' => DELETED
        ]);
    }

    public function updateToCampaigner($request, $id, $pathKTP)
    {
        User::where('id', $id)->update([
            'accountNumber' => $request->rekening,
            'nik' => $request->nik,
            'ktpPicture' => $pathKTP,
            'status' => 3
        ]);
    }

    public function updateAccountNumber($request, $id)
    {
        User::where('id', $id)->update([
            'accountNumber' => $request->rekening
        ]);
    }

    public function changePassword($user, $password)
    {
        User::where('id', $user->id)->update([
            'password' => $password
        ]);
    }

    //* =========================================================================================
    //* --------------------------------------- DAO Auth ----------------------------------------
    //* =========================================================================================
    public function login($request)
    {
        return Auth::attempt([
            'email' =>  $request->email,
            'password' => $request->password
        ]);
    }

    public function register($data)
    {
        return $data->save();
    }

    public function reset($token, $request)
    {
        return DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
    }

    public function mail($token, $request, $view, $subject)
    {
        Mail::send($view, ['token' => $token, 'email' => $request->email], function ($message) use ($request, $subject) {
            $message->to($request->email);
            $message->subject($subject);
        });
    }

    public function getPasswordReset($request)
    {
        return DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();
    }

    public function updateUser($request)
    {
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
    }

    public function deleteToken($request)
    {
        DB::table('password_resets')->where(['email' => $request->email])->delete();
    }
}
