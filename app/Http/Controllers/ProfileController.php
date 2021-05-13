<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;
use App\Domain\Profile\Service\ProfileService;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    private $profile_service;

    public function __construct()
    {
        $this->profile_service = new ProfileService();
    }

    // Detail dan Update User General Data
    public function getViewDetailAnUser()
    {
        $user = $this->profile_service->getAProfile();
        return view('profile.profile', compact('user'));
    }

    public function updateAnUserData(Request $request)
    {
        $user = $this->profile_service->getAProfile();
        $this->profile_service->updateProfile($request, $user->id);
        return redirect('/profile');
    }

    // Update data campaigner, upgrade ke campaigner, atau edit pengajuan campaigner
    public function detailDataCampaigner()
    {
        $user = $this->profile_service->getAProfile();
        return view('profile.detailCampaigner', compact('user'));
    }

    public function processDataCampaigner(Request $request)
    {
        $user = $this->profile_service->getAProfile();

        if ($user->role == CAMPAIGNER) {
            $validator = Validator::make($request->all(), [
                'rekening' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|min:16',
                'rekening' => 'required',
                'KTP_picture' => 'required|image'
            ]);
        }

        if ($validator->fails()) {
            $messageError = [];
            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }

            return redirect('/profile')->with(['type' => "error", 'message' => $messageError]);
        };

        $this->profile_service->updateCampaigner($request, $user);
        return redirect('/profile')->with(['type' => "success", 'message' => "Permintaan Anda akan diproses. Tunggu konfirmasi dari admin."]);
    }

    // Update password
    public function getViewChangePassword()
    {
        return view('profile.changePassword');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'verification' => 'required'
        ]);

        if ($validator->fails()) {
            $messageError = [];
            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }
            return redirect('/change')->with(['type' => 'error', 'message' => $messageError]);
        };

        $change = $this->profile_service->changePassword($request);

        if ($change == 'failed_verification') {
            return redirect('/change')->with(['type' => 'error', 'message' => "Password baru dengan password verifikasi tidak sesuai."]);
        }

        if ($change == 'failed_password') {
            return redirect('/change')->with(['type' => 'error', 'message' => "Sandi saat ini tidak sesuai dengan pasword lama."]);
        }

        return redirect('/logout')->with(['type' => 'success', 'message' => "Password telah diganti. Silahkan login ulang."]);
    }

    // Hapus Akun
    public function deleteAnUserAccount()
    {
        $user = $this->profile_service->getAProfile();
        $this->profile_service->deleteAccount($user->id);
        return redirect('logout');
    }
}
