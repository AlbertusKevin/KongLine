<?php

namespace App\Domain\Event\Model;

class Petition extends Event
{
    //attribute
    private $signedCollected, $signedTarget, $targetPerson;

    public function __construct()
    {
        $this->idCampaigner = 2;
    }
}
