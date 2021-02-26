<?php

namespace App\Domain\Event\Dao;

use App\Domain\Event\Entity\Category;
use App\Domain\Event\Entity\DetailAllocation;
use App\Domain\Event\Entity\Donation;
use App\Domain\Event\Entity\EventStatus;
use App\Domain\Event\Entity\Forum;
use App\Domain\Event\Entity\ForumLike;
use App\Domain\Event\Entity\ParticipateDonation;
use App\Domain\Event\Entity\ParticipatePetition;
use App\Domain\Event\Entity\Petition;
use App\Domain\Event\Entity\Service;
use App\Domain\Event\Entity\Transaction;
use App\Domain\Event\Entity\UpdateNews;
use App\Domain\Event\Entity\User;

class EventDao
{
    //? ===================================================================
    //! ~~~~~~~~~~~~~~~~~~~~~~~~~ Profile Dao ~~~~~~~~~~~~~~~~~~~~~~~~
    //? ===================================================================

    public function showProfile($id)
    {
        return User::where('id', $id)->first();
    }

    public function updateProfile($request, $id, $pathProfile, $pathBackground)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'aboutMe' => $request->aboutMe,
            'city' => $request->city,
            'linkProfile' => $request->linkProfile,
            'address' => $request->address,
            'zipCode' => $request->zipCode,
            'phoneNumber' => $request->phoneNumber,
            'photoProfile' => $pathProfile,
            'backgroundPicture' => $pathBackground
        ]);
    }

    //? ===================================================================
    //! ~~~~~~~~~~~~~~~~~~~~~~~~~~~ Petition Dao ~~~~~~~~~~~~~~~~~~~~~~~~~~
    //? ===================================================================
    public function listPetitionType($status)
    {
        return Petition::where('status', $status)->get();
    }

    public function listPetitionParticipated($idParticipant)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->get();
    }

    public function listPetitionByMe($idCampaigner)
    {
        return Petition::where('idCampaigner', $idCampaigner)->get();
    }

    public function indexPetition()
    {
        return Petition::where('status', 1)->get();
    }

    public function showPetition($id)
    {
        return Petition::where('status', 1)->where('id', $id)->first();
    }

    public function checkParticipated($idEvent, $idParticipant, $typeEvent)
    {
        if ($typeEvent == 'petition') {
            return ParticipatePetition::where('idParticipant', $idParticipant)->where('idPetition', $idEvent)->first();
        } else {
            return ParticipateDonation::where('idParticipant', $idParticipant)->where('idDonation', $idEvent)->first();
        }
    }
}
