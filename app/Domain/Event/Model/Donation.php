<?php

namespace App\Domain\Event\Model;

class Donation extends Event
{
    // Attribute
    private $assistedSubject, $donationCollected, $donationTarget, $totalDonatur, $bank, $accountNumber;

    public function __construct($idCampaigner, $title, $photo, $category, $purpose, $deadline, $status, $created_at, $donationCollected, $donationTarget, $totalDonatur, $assistedSubject, $bank, $accountNumber)
    {
        parent::__construct($idCampaigner, $title, $photo, $category, $purpose, $deadline, $status, $created_at);
        $this->assistedSubject = $assistedSubject;
        $this->donationCollected = $donationCollected;
        $this->donationTarget = $donationTarget;
        $this->accountNumber = $accountNumber;
        $this->bank = $bank;
        $this->totalDonatur = $totalDonatur;
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
}
