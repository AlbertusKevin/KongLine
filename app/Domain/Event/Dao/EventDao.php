<?php

namespace App\Domain\Event\Dao;

use App\Domain\Profile\Entity\User;
use App\Domain\Event\Entity\Category;
use App\Domain\Donation\Entity\ParticipateDonation;
use App\Domain\Petition\Entity\ParticipatePetition;

class EventDao
{
    //! Memeriksa apakah participant pernah berpartisipasi pada event tertentu
    public function verifyProfileCreateEvent($email, $phone)
    {
        return User::where('email', $email)->where('phoneNumber', $phone)->first();
    }

    public function getAllCategoriesEvent()
    {
        return Category::all();
    }

    public static function getACategory($id)
    {
        return Category::where('id', $id)->first();
    }

    public function checkParticipated($idEvent, $idParticipant, $typeEvent)
    {
        if ($typeEvent == PETITION) {
            return ParticipatePetition::where('idParticipant', $idParticipant)->where('idPetition', $idEvent)->first();
        }

        return ParticipateDonation::where('idParticipant', $idParticipant)->where('idDonation', $idEvent)->first();
    }
}
