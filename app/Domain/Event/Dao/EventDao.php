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
use Carbon\Carbon;

class EventDao
{
    //? ===================================================================
    //! ~~~~~~~~~~~~~~~~~~~~~~~~~ Profile Dao ~~~~~~~~~~~~~~~~~~~~~~~~
    //? ===================================================================

    public function showProfile($id)
    {
        return User::where('id', $id)->first();
    }

    public function updateProfile($request, $id)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'aboutMe' => $request->aboutMe,
            'city' => $request->city,
            'linkProfile' => $request->linkProfile,
            'address' => $request->address,
            'zipCode' => $request->zipCode,
            'phoneNumber' => $request->phoneNumber
        ]);
    }

    //? ===================================================================
    //! ~~~~~~~~~~~~~~~~~~~~~~~~~~~ Petition Dao ~~~~~~~~~~~~~~~~~~~~~~~~~~
    //? ===================================================================
    //! Petition Search
    public function searchPetition($status, $keyword)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function searchPetitionByMe($idCampaigner, $keyword)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function searchPetitionByMeCategorySort($idCampaigner, $keyword, $category, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();
    }

    public function searchPetitionByMeCategory($idCampaigner, $keyword, $category)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function searchPetitionByMeSort($idCampaigner, $keyword, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();
    }

    public function searchPetitionParticipated($idParticipant, $keyword)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function searchPetitionParticipatedCategorySort($idParticipant, $keyword, $category, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    public function searchPetitionParticipatedSortBy($idParticipant, $keyword, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    public function searchPetitionParticipatedCategory($idParticipant, $keyword, $category)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->get();
    }

    public function searchPetitionCategorySort($status, $keyword, $category, $table)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->where('category', $category)
            ->orderByDesc($table)
            ->get();
    }

    public function searchPetitionCategory($status, $keyword, $category)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->where('category', $category)
            ->get();;
    }

    public function searchPetitionSortBy($status, $keyword, $table)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();;
    }

    //! Petition Sort and Category
    public function sortPetitionCategory($category, $status, $table)
    {
        return Petition::where('status', $status)
            ->where('category', $category)
            ->orderByDesc($table)
            ->get();
    }

    public function sortPetition($status, $table)
    {
        return Petition::where('status', $status)
            ->orderByDesc('signedCollected', $table)
            ->get();
    }

    public function petitionByCategory($category, $status)
    {
        return Petition::where('status', $status)
            ->where('category', $category)
            ->get();
    }

    public function sortPetitionCategoryByMe($category, $idCampaigner, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->orderByDesc($table)
            ->get();
    }

    public function sortMyPetition($idCampaigner, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->orderByDesc($table)
            ->get();
    }

    public function myPetitionByCategory($category, $idCampaigner)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->get();
    }

    public function sortPetitionCategoryParticipated($category, $idParticipant, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.category', $category)
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    public function sortPetitionParticipated($idParticipant, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    public function participatedPetitionByCategory($category, $idParticipant)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.category', $category)
            ->get();
    }

    //! List Petition By Type
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

    //! List Petition (Regular)
    public function indexPetition()
    {
        return Petition::where('status', 1)->get();
    }

    public function showPetition($id)
    {
        return Petition::where('status', 1)->where('id', $id)->first();
    }

    public function signPetition($request, $idEvent, $user)
    {
        return ParticipatePetition::create([
            'idPetition' => $idEvent,
            'idParticipant' => $user->id,
            'comment' => $request->petitionComment,
            'created_at' => Carbon::now()->format('Y-m-d')
        ]);
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
