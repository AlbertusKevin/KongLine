<?php

namespace App\Domain\Event\Model;

class Transaction
{
    //attribute
    private $idDonation, $idParticipant, $accountNumber, $nominal, $repaymentPicture, $annonymousDonate, $status, $created_at;

    public function __construct($idDonation, $idParticipant, $accountNumber, $nominal, $annonymousDonate, $status, $created_at)
    {
        $this->idDonation = $idDonation;
        $this->idParticipant = $idParticipant;
        $this->accountNumber = $accountNumber;
        $this->nominal = $nominal;
        $this->annonymousDonate = $annonymousDonate;
        $this->status = $status;
        $this->created_at = $created_at;
    }

    public function getIdDonation()
    {
        return $this->idDonation;
    }

    public function getIdParticipant()
    {
        return $this->idParticipant;
    }

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function getNominal()
    {
        return $this->nominal;
    }

    public function getRepaymentPicture()
    {
        return $this->repaymentPicture;
    }

    public function getAnnonymous()
    {
        return $this->annonymousDonate;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
