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

    public function getListDonationLimit()
    {
        return Donation::all()->sortByDesc("created_at")->take(3);
    }

    public function getListPetitionLimit()
    {
        return Petition::all()->sortByDesc("created_at")->take(3);
    }
}
