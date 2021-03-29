<?php

namespace App\Domain\Event\Model;

class ParticipateDonation
{
    //attribute
    private $idPetition, $idParticipant, $comment, $created_at;

    public function __construct($idPetition, $idParticipant, $comment, $created_at)
    {
        $this->idPetition = $idPetition;
        $this->idParticipant = $idParticipant;
        $this->comment = $comment;
        $this->created_at = $created_at;
    }

    public function getIdPetition()
    {
        return $this->idPetition;
    }

    public function getIdParticipant()
    {
        return $this->idParticipant;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
