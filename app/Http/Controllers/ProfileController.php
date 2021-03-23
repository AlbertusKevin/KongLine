<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Event\Service\EventService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    private $event_service;

    public function __construct()
    {
        $this->event_service = new EventService();
    }

    public function edit($id)
    {
        $user = $this->event_service->editProfile($id);
        return view('profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->event_service->updateProfile($request, $id);
        return redirect('profile' . $id);
    }

    public function delete($id)
    {
        $this->event_service->deleteAccount($id);
        return redirect('logout');
    }

    public function editCampaigner($id)
    {
        $user = $this->event_service->editProfile($id);
        return view('updateCampaigner', compact('user'));
    }

    public function updateCampaigner(Request $request, $id)
    {
        $user = $this->event_service->showProfile($id);
        if($user->role == 'campaigner'){
            $validator = Validator::make($request->all(), [
                'nik' => 'required|min:16',
                'rekening' => 'required',
            ]);
        }else{
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
            return redirect('/profile/campaigner' . $id);
        };

        $this->event_service->requestUserToCampaigner($request, $id);
        return redirect('/profile/' . $id);
    }

    public function dataCampaigner($id)
    {
        $user = $this->event_service->showProfile($id);
        return view('detailCampaigner', compact('user'));
    }

    public function viewChangePassword($id)
    {
        return view('changePassword');
    }

    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'verifikasi' => 'required'
        ]);

        if ($validator->fails()) {
            $messageError = [];
            foreach ($validator->errors()->all() as $message) {
                $messageError = $message;
            }
            Alert::error('Validasi Error', [$messageError]);
            return redirect('/change/' . $id);
        };

        $change = $this->event_service->changePassword($request);

        if($change == 'failed_verification'){
            Alert::error('Validasi Error', "Password baru dengan password verifikasi tidak sesuai.");
            return redirect('/change/' . $id);
        }

        if($change == 'failed_password'){
            Alert::error('Password Tidak Cocok', 'Sandi saat ini tidak sesuai dengan pasword lama');
            return redirect('/change/' . $id);
        }

        Alert::success('Berhasil', "Password telah diganti. Silahkan login ulang.");
        return redirect('/logout');
    }
}