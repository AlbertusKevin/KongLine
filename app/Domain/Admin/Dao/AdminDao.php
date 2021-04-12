<?php

namespace App\Domain\Admin\Dao;

use App\Domain\Event\Entity\Donation;
use App\Domain\Event\Entity\User;
use App\Domain\Event\Entity\ParticipateDonation;
use App\Domain\Event\Entity\ParticipatePetition;
use App\Domain\Event\Entity\Petition;

class AdminDao
{
    public function getAllUser()
    {
        return User::all();
    }

    public function getCountParticipant()
    {
        return User::where('role', 'participant')->count();
    }

    public function getCountCampaigner()
    {
        return User::where('role', 'campaigner')->count();
    }

    public function getCountWaitingCampaigner()
    {
        return User::where('status', 3)->count();
    }

    public function getCountWaitingDonation()
    {
        return Donation::where('status', 0)->count();
    }

    public function getCountWaitingPetition()
    {
        return Petition::where('status', 0)->count();
    }

    public function getCountParticipatePetition($id)
    {
        return ParticipatePetition::where('idParticipant', $id)->count();
    }

    public function getCountParticipateDonation($id)
    {
        return ParticipateDonation::where('idParticipant', $id)->count();
    }

    public function listUserByRole($role)
    {
        return User::where('role', $role)->get();
    }

    public function listUserByAll()
    {
        return User::where('role', '!=', 'admin')
            ->orWhereNull('role')
            ->get();
    }

    public function listUserByPengajuan()
    {
        return User::where('status', '==', 3)->get();
    }

    public function sortByTanggalDibuat($role)
    {
        return User::where('role', $role)
            ->orderBy('created_at', 'asc')->get();
    }

    public function sortByNama($role)
    {
        return User::where('role', $role)
            ->orderBy('name', 'asc')->get();
    }

    public function sortByEmail($role)
    {
        return User::where('role', $role)
            ->orderBy('email', 'asc')->get();
    }

    public function sortByTanggalDibuatAllUser()
    {
        return User::orderBy('created_at', 'asc')->get();
    }

    public function sortByNamaAllUser()
    {
        return User::orderBy('name', 'asc')->get();
    }

    public function sortByEmailAllUser()
    {
        return User::orderBy('email', 'asc')->get();
    }

    public function getListDonationLimit()
    {
        return Donation::all()->sortByDesc("created_at")->take(3);
    }

    public function getListPetitionLimit()
    {
        return Petition::all()->sortByDesc("created_at")->take(3);
    }
    
    public function searchUserAll($keyword)
    {
        return User::where('name', 'LIKE', '%' . $keyword . '%')->get();
    }

    public function searchUserParticipant($keyword)
    {
        return User::where('role', '=', 'participant')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function searchUserCampaigner($keyword)
    {
        return User::where('role' ,'=', 'campaigner')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function searchUserPengajuan($keyword)
    {
        return User::where('status' , '=', 3)
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function updateUserCountEvent($userId, $total)
    {
        $user = User::where('id','=',$userId)->first();
        $user->countEvent = $total;
        $user->save();
    }
}
