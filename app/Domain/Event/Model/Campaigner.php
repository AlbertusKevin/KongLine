<?php

namespace App\Domain\Event\Model;

class Campaigner extends Participant
{
    //attribute
    private $accountNumber, $ktpPicture, $nik;

    public function __construct($name, $email, $password, $accountNumber, $ktpPicture, $nik)
    {
        parent::__construct($name, $email, $password);
        $this->accountNumber = $accountNumber;
        $this->ktpPicture = $ktpPicture;
        $this->nik = $nik;
    }

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function getKtpPicture()
    {
        return $this->ktpPicture;
    }

    public function getNik()
    {
        return $this->nik;
    }
}
