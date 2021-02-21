<?php

namespace App\Domain\Event\Service;

use App\Event\Dao\EventDao;

class EventService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new EventDao();
    }
    
    public function namefunction1()
    {

    }

    public function namefunction2()
    {
        
    }
}