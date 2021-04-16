<?php

namespace App\Domain\Event\Model;

class DetailAllocation
{
    private $id, $idDonation, $description, $nominal;

    public function __construct($idDonation, $description, $nominal)
    {
        $this->idDonation = $idDonation;
        $this->description = $description;
        $this->nominal = $nominal;
    }

    public function getIdDonation()
    {
        return $this->idDonation;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getNominal()
    {
        return $this->nominal;
    }
}
