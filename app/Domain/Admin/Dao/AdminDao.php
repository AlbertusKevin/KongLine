<?php

namespace App\Domain\Admin\Dao;

use App\Admin\Entity\CommentForum;
use App\Admin\Entity\StatusUser;
use App\Domain\Event\Entity\User;

class AdminDao
{
    public function getAllUser()
    {
        return User::all();
    }

    public function namefunction2()
    {
        
    }
}