<?php

namespace App\Domain\Admin\Service;

use App\Domain\Admin\Dao\AdminDao;
use Illuminate\Support\Carbon;

class AdminService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new AdminDao();
    }

    //Mengambil semua user yang ada di DB
    public function getAllUser()
    {
        return $this->dao->getAllUser();
    }

    // Menghitung jumlah partisipasi setiap user
    public function countEventParticipate($users)
    {
        $eventCount = array();

        foreach ($users as $user) {
            $totalCount = array();

            $countPetition = $this->dao->getCountParticipatePetition($user->id);
            $countDonation = $this->dao->getCountParticipateDonation($user->id);

            $total = $countDonation + $countPetition;
            array_push($totalCount, $user->id, $total);
            array_push($eventCount, $totalCount);
        }

        return $eventCount;
    }

    //Mengubah Format tanggal, ex:2019-10-02 ---> 2019/10/02
    public function changeDateFormat()
    {
        $users = $this->dao->getAllUser();
        $tanggal = array();
        foreach ($users as $user) {
            $tanggalDibuat = $user->created_at;
            $tanggalDibuat = explode(" ", $tanggalDibuat);
            $tanggalDibuat = str_replace("-", "/", $tanggalDibuat[0]);
            array_push($tanggal, $tanggalDibuat);
        }
        return $tanggal;
    }

    public function listUserByRole($request)
    {
        $roleType = $request->roleType;

        if ($roleType == PARTICIPANT or $roleType == CAMPAIGNER) {
            return $this->dao->listUserByRole($roleType);
        } elseif ($roleType == PENGAJUAN) {
            return $this->dao->listUserByPengajuan();
        } elseif ($roleType == SEMUA) {
            return $this->dao->listUserByAll();
        }
    }

    public function countUser()
    {
        $user = $this->dao->getAllUser();
        return $user->count();
    }

    public function countParticipant()
    {
        return $this->dao->getCountParticipant();
    }

    public function countCampaigner()
    {
        return $this->dao->getCountCampaigner();
    }

    public function countWaitingCampaigner()
    {
        return $this->dao->getCountWaitingCampaigner();
    }

    public function countWaitingPetition()
    {
        return $this->dao->getCountWaitingPetition();
    }

    public function countWaitingDonation()
    {
        return $this->dao->getCountWaitingDonation();
    }

    public function getDonationLimit()
    {
        return $this->dao->getListDonationLimit();
    }

    public function getPetitionLimit()
    {
        return $this->dao->getListPetitionLimit();
    }

    public function getDate()
    {
        return Carbon::now()->format('d-m-Y');
    }
}
