<?php

namespace App\Domain\Event\Model;

class ParticipateDonation
{
    //attribute
    private $idDonation, $idParticipant, $comment, $created_at, $annymousComment;

    public function __construct($idDonation, $idParticipant, $comment, $created_at, $annymousComment)
    {
        $this->idDonation = $idDonation;
        $this->idParticipant = $idParticipant;
        $this->comment = $comment;
        $this->created_at = $created_at;
        $this->annymousComment = $annymousComment;
    }

    public function getIdDonation()
    {
        return $this->idDonation;
    }

    public function getIdParticipant()
    {
        return $this->idParticipant;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getAnnonymous()
    {
        return $this->annymousComment;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
