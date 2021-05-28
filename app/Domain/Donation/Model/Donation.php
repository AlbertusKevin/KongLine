<?php

namespace App\Domain\Donation\Model;

use App\Domain\Event\Model\Event;

class Donation extends Event
{
    // Attribute
    private $assistedSubject, $donationCollected, $donationTarget, $totalDonatur, $bank, $accountNumber, $duration_event;

    public function __construct($idCampaigner, $title, $photo, $category, $purpose, $status, $created_at, $updated_at, $donationCollected, $donationTarget, $totalDonatur, $assistedSubject, $bank, $accountNumber, $duration_event)
    {
        parent::__construct($idCampaigner, $title, $photo, $category, $purpose, $status, $created_at, $updated_at);
        $this->assistedSubject = $assistedSubject;
        $this->donationCollected = $donationCollected;
        $this->donationTarget = $donationTarget;
        $this->accountNumber = $accountNumber;
        $this->bank = $bank;
        $this->totalDonatur = $totalDonatur;
        $this->duration_event = $duration_event;
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

    public function getStatus()
    {
        return parent::getStatus();
    }

    public function getCreatedAt()
    {
        return parent::getCreatedAt();
    }

    public function getUpdatedAt()
    {
        return parent::getUpdatedAt();
    }

    public function getAssistedSubject()
    {
        return $this->assistedSubject;
    }

    public function getDonationCollected()
    {
        return $this->donationCollected;
    }

    public function getDonationTarget()
    {
        return $this->donationTarget;
    }

    public function getTotalDonatur()
    {
        return $this->totalDonatur;
    }

    public function getBank()
    {
        return $this->bank;
    }
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function getDuration()
    {
        return $this->duration_event;
    }
}
