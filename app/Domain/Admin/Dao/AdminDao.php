<?php

namespace App\Domain\Admin\Dao;

use App\Admin\Entity\CommentForum;
use App\Admin\Entity\StatusUser;
use App\Domain\Event\Entity\User;
use App\Domain\Event\Entity\ParticipateDonation;
use App\Domain\Event\Entity\ParticipatePetition;

class AdminDao
{
    public function getAllUser()
    {
        return User::all();
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
}