<?php

namespace App\Domain\Profile\Service;

use App\Domain\Helper\HelperService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Domain\Profile\Entity\User;
use App\Domain\Profile\Dao\ProfileDao;
use Illuminate\Support\Str;

class ProfileService
{
    private $profile_dao;

    public function __construct()
    {
        $this->profile_dao = new ProfileDao();
    }

    public function getUsers()
    {
        return $this->profile_dao->getUsers();
    }

    // Ambil data user, jika login, return data yang sebenarnya, jika tidak, return guest
    public function getAProfile()
    {
        if (Auth::check()) {
            return Auth::user();
        }

        return $this->profile_dao->getAProfile(GUEST_ID);
    }

    public function getACampaigner($id)
    {
        return $this->profile_dao->getAProfile($id);
    }

    // Memproses update profile
    public function updateProfile($request, $id)
    {
        $pathProfile = HelperService::uploadImage($request->file('profile_picture'), 'profile/photo');
        $pathBackground = HelperService::uploadImage($request->file('zoom_picture'), 'profile/background');
        $this->profile_dao->updateProfile($request, $id, $pathProfile, $pathBackground);
    }

    public function deleteAccount($id)
    {
        return $this->profile_dao->deleteAccount($id);
    }

    public function updateCampaigner($request, $user)
    {
        if ($user->role == CAMPAIGNER) {
            return $this->profile_dao->updateAccountNumber($request, $user->id);
        }

        $pathKTP = HelperService::uploadImage($request->file('KTP_picture'), 'profile/KTP');
        return $this->profile_dao->updateToCampaigner($request, $user->id, $pathKTP);
    }

    public function changePassword($request)
    {

        $user = $this->getAProfile();

        if (Hash::check($request->old_password, $user->password)) {
            if ($request->new_password == $request->verification) {
                $password = Hash::make($request->new_password);
                $this->profile_dao->changePassword($user, $password);
                return 'true';
            }
            return 'failed_verification';
        }

        return 'failed_password';
    }

    public function updateCountEventParticipatedByUser($idUser, $totalEvent)
    {
        $this->profile_dao->updateCountEventParticipatedByUser($idUser, $totalEvent);
    }

    //* =========================================================================================
    //* ------------------------------------- Service Auth --------------------------------------
    //* =========================================================================================
    public function authLogin($request)
    {
        return $this->profile_dao->login($request);
    }

    public function authRegis($request)
    {
        $user = new User();
        $user->name = $request->firstname . ' ' . $request->lastname;
        $user->email = $request->email;
        $user->status = ACTIVE;
        $user->role = PARTICIPANT;
        $user->photoProfile = DEFAULT_PROFILE;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        return $this->profile_dao->register($user);
    }

    public function authForgotPassword($request, $view, $subject)
    {
        $token = Str::random(64);

        $resultReset = $this->profile_dao->reset($token, $request);
        $resultMail = $this->profile_dao->mail($token, $request, $view, $subject);

        if ($resultReset && $resultMail) {
            return true;
        }

        return false;
    }

    public function authReset($request)
    {

        $resultGetPassword = $this->profile_dao->getPasswordReset($request);

        if ($resultGetPassword) {
            $this->profile_dao->updateUser($request);
            $this->profile_dao->deleteToken($request);

            return true;
        }

        return false;
    }
}
