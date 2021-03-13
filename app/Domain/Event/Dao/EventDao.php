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
            ->orderByDesc($table)
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
        return Petition::where('id', $id)->first();
    }

    public function commentsPetition($id)
    {
        return ParticipatePetition::where('idPetition', $id)
            ->join('users', 'participate_petition.idParticipant', '=', 'users.id')
            ->get();
    }

    public function newsPetition($id)
    {
        return UpdateNews::where('idPetition', $id)->get();
    }

    public function storeProgressPetition($updateNews)
    {
        UpdateNews::create([
            'idPetition' => $updateNews->getIdPetition(),
            'image' => $updateNews->getImage(),
            'title' => $updateNews->getTitle(),
            'content' => $updateNews->getContent(),
            'link' => $updateNews->getLink(),
            'created_at' => $updateNews->getCreatedAt()
        ]);
    }

    public function storePetition($petition)
    {
        Petition::create([
            'idCampaigner' => $petition->getIdCampaigner(),
            'title' => $petition->getTitle(),
            'photo' => $petition->getPhoto(),
            'category' => $petition->getCategory(),
            'purpose' => $petition->getPurpose(),
            'deadline' => $petition->getDeadline(),
            'status' => $petition->getStatus(),
            'created_at' => $petition->getCreatedAt(),
            'signedCollected' => $petition->getSignedCollected(),
            'signedTarget' => $petition->getSignedTarget(),
            'targetPerson' => $petition->getTargetPerson()
        ]);
    }

    public function listCategory()
    {
        return Category::all();
    }

    public function signPetition($petition)
    {
        return ParticipatePetition::create([
            'idPetition' => $petition->idPetition,
            'idParticipant' => $petition->idParticipant,
            'comment' => $petition->comment,
            'created_at' => Carbon::now()->format('Y-m-d')
        ]);
    }

    public function calculatedSign($idEvent)
    {
        return ParticipatePetition::where('idPetition', $idEvent)->count();
    }

    public function updateCalculatedSign($idEvent, $count)
    {
        return Petition::where('id', $idEvent)->update([
            'signedCollected' => $count
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
