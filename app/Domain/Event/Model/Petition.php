<?php

namespace App\Domain\Event\Model;

class Petition extends Event
{
    //attribute
    private $signedCollected, $signedTarget, $targetPerson;

    public function __construct($idCampaigner, $title, $photo, $category, $purpose, $deadline, $status, $created_at, $signedTarget, $signedCollected, $targetPerson)
    {
        parent::__construct($idCampaigner, $title, $photo, $category, $purpose, $deadline, $status, $created_at);
        $this->signedTarget = $signedTarget;
        $this->signedCollected = $signedCollected;
        $this->targetPerson = $targetPerson;
    }

    public function setPhoto($img)
    {
        return parent::setPhoto($img);
    }

    public function getPhoto()
    {
        return parent::getPhoto();
    }

    public function getIdCampaigner()
    {
        return parent::getIdCampaigner();
    }

    public function getTitle()
    {
        return parent::getTitle();
    }

    public function getCategory()
    {
        return parent::getCategory();
    }

    public function getPurpose()
    {
        return parent::getPurpose();
    }

    public function getDeadline()
    {
        return parent::getDeadline();
    }

    public function getStatus()
    {
        return parent::getStatus();
    }

    public function getCreatedAt()
    {
        return parent::getCreatedAt();
    }

    public function getSignedCollected()
    {
        return $this->signedCollected;
    }

    public function getSignedTarget()
    {
        return $this->signedTarget;
    }

    public function getTargetPerson()
    {
        return $this->targetPerson;
    }
}
