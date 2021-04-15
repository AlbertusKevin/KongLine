<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    private $event_service;

    public function __construct()
    {
        $this->event_service = new EventService();
    }

    public function edit()
    {
        $user = $this->event_service->showProfile();
        return view('profile.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $this->event_service->showProfile();
        $this->event_service->updateProfile($request, $user->id);
        return redirect('/profile');
    }

    public function delete()
    {
        $user = $this->event_service->showProfile();
        $this->event_service->deleteAccount($user->id);
        return redirect('logout');
    }

    public function editCampaigner()
    {
        $user = $this->event_service->showProfile();
        if ($user->role == CAMPAIGNER) {
            return redirect('/campaigner');
        }
        return view('profile.updateCampaigner', compact('user'));
    }

    public function updateCampaigner(Request $request)
    {
        $user = $this->event_service->showProfile();

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

            Alert::error('Validasi Error', [$messageError]);
            return redirect('/profile/campaigner');
        };

        $this->event_service->updateCampaigner($request, $user);
        Alert::success('Berhasil', "Nomor rekening Anda sudah diupdate.");
        return redirect('/profile/campaigner');
    }

    public function dataCampaigner()
    {
        $user = $this->event_service->showProfile();
        return view('profile.detailCampaigner', compact('user'));
    }

    public function viewChangePassword()
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
            Alert::error('Validasi Error', [$messageError]);
            return redirect('/change');
        };

        $change = $this->event_service->changePassword($request);

        if ($change == 'failed_verification') {
            Alert::error('Validasi Error', "Password baru dengan password verifikasi tidak sesuai.");
            return redirect('/change');
        }

        if ($change == 'failed_password') {
            Alert::error('Password Tidak Cocok', 'Sandi saat ini tidak sesuai dengan pasword lama');
            return redirect('/change');
        }

        Alert::success('Berhasil', "Password telah diganti. Silahkan login ulang.");
        return redirect('/logout');
    }
}
