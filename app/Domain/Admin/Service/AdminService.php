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

    public function namefunction2()
    {
        
    }
}