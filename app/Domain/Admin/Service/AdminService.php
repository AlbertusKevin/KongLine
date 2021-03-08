<?php

namespace App\Domain\Admin\Service;

use App\Domain\Admin\Dao\AdminDao;

class AdminService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new AdminDao();
    }

    public function getAllUser()
    {
        return $this->dao->getAllUser();
    }

    public function countEventParticipate()
    {
        $users = $this->dao->getAllUser();
        $eventCount = array();
        foreach ($users as $user) {
            $countPetition = $this->dao->getCountParticipatePetition($user->id);   
            $countDonation = $this->dao->getCountParticipateDonation($user->id);
            $total = $countDonation + $countPetition;
            array_push($eventCount, $total);
        }
        return $eventCount;
    }

    public function changeDateFormat()
    {
        $users = $this->dao->getAllUser();
        $tanggal = array();
        foreach ($users as $user) {
            $tanggalDibuat = $user->created_at;
            $tanggalDibuat = explode(" ",$tanggalDibuat);
            $tanggalDibuat = str_replace("-","/",$tanggalDibuat[0]);
            array_push($tanggal, $tanggalDibuat);
            
        }
        return $tanggal;
    }
}