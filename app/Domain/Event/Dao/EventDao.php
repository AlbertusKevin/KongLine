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
    //! Mengambil data kategori event yang ada
    public function listCategory()
    {
        return Category::all();
    }

    //! Memeriksa apakah participant pernah berpartisipasi pada event tertentu
    public function checkParticipated($idEvent, $idParticipant, $typeEvent)
    {
        if ($typeEvent == 'petition') {
            return ParticipatePetition::where('idParticipant', $idParticipant)->where('idPetition', $idEvent)->first();
        } else {
            return ParticipateDonation::where('idParticipant', $idParticipant)->where('idDonation', $idEvent)->first();
        }
    }

    //* =========================================================================================
    //* ------------------------------------- DAO Profile ---------------------------------------
    //* =========================================================================================
    //! Mengambil data user berdasarkan id
    public function showProfile($id)
    {
        return User::where('id', $id)->first();
    }

    //! Memproses update data profile
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

    public function deleteAccount($id)
    {
        User::where('id', $id)->update([
            'status' => 0
        ]);
    }

    //* =========================================================================================
    //* -------------------------------------- DAO Petisi ---------------------------------------
    //* =========================================================================================
    //! Mencari petisi sesuai dengan 
    //! status (berdasarkan tipe petisi) dan keyword tertentu

    public function searchPetition($status, $keyword)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //! Mencari petisi yang dibuat oleh campaigner sesuai dengan
    //! keyword tertentu
    public function searchPetitionByMe($idCampaigner, $keyword)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //! Mencari petisi yang dibuat oleh campaigner sesuai dengan 
    //! keyword, sorting desc, dan kategori tertentu
    public function searchPetitionByMeCategorySort($idCampaigner, $keyword, $category, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();
    }

    //! Mencari petisi yang dibuat oleh campaigner sesuai dengan
    //! keyword dan kategori tertentu
    public function searchPetitionByMeCategory($idCampaigner, $keyword, $category)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //! Mencari petisi yang dibuat oleh campaigner
    //! sesuai dengan keyword dan sorting desc tertentu
    public function searchPetitionByMeSort($idCampaigner, $keyword, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();
    }

    //! Mencari petisi yang pernah diikuti oleh participant sesuai dengan
    //! keyword tertentu
    public function searchPetitionParticipated($idParticipant, $keyword)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    //! Mencari petisi yang pernah diikuti oleh participant sesuai dengan
    //! keyword, sorting desc, dan kategori tertentu
    public function searchPetitionParticipatedCategorySort($idParticipant, $keyword, $category, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    //! Mencari petisi yang pernah diikuti oleh participant sesuai dengan
    //! keyword dan sorting desc tertentu
    public function searchPetitionParticipatedSortBy($idParticipant, $keyword, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    //! Mencari petisi yang pernah diikuti oleh participant sesuai dengan
    //! keyword dan kategori tertentu
    public function searchPetitionParticipatedCategory($idParticipant, $keyword, $category)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->get();
    }

    //! Mencari petisi sesuai dengan
    //! keyword, sorting desc, dan kategori tertentu
    public function searchPetitionCategorySort($status, $keyword, $category, $table)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->where('category', $category)
            ->orderByDesc($table)
            ->get();
    }

    //! Mencari petisi sesuai dengan
    //! keyword dan kategori tertentu
    public function searchPetitionCategory($status, $keyword, $category)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->where('category', $category)
            ->get();;
    }

    //! Mencari petisi sesuai dengan
    //! keyword dan sorting desc tertentu
    public function searchPetitionSortBy($status, $keyword, $table)
    {
        return Petition::where('status', $status)
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();;
    }

    //! Mengurutkan petisi sesuai dengan
    //! sorting desc dan kategori tertentu
    public function sortPetitionCategory($category, $status, $table)
    {
        return Petition::where('status', $status)
            ->where('category', $category)
            ->orderByDesc($table)
            ->get();
    }

    //! Mengurutkan petisi dengan status tertentu 
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortPetition($status, $table)
    {
        return Petition::where('status', $status)
            ->orderByDesc($table)
            ->get();
    }

    //! Menampilkan petisi dengan status tertentu sesuai kategori tertentu
    public function petitionByCategory($category, $status)
    {
        return Petition::where('status', $status)
            ->where('category', $category)
            ->get();
    }

    //! Mengurutkan petisi yang dibuat oleh campaigner dan sesuai kategori tertentu 
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortPetitionCategoryByMe($category, $idCampaigner, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->orderByDesc($table)
            ->get();
    }

    //! Mengurutkan petisi yang dibuat oleh campaigner
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortMyPetition($idCampaigner, $table)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->orderByDesc($table)
            ->get();
    }

    //! Menampilkan petisi yang dibuat oleh campaigner sesuai kategori tertentu
    public function myPetitionByCategory($category, $idCampaigner)
    {
        return Petition::where('idCampaigner', $idCampaigner)
            ->where('category', $category)
            ->get();
    }

    //! Mengurutkan petisi yang pernah diikuti participant sesuai kategori tertentu 
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortPetitionCategoryParticipated($category, $idParticipant, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.category', $category)
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    //! Mengurutkan petisi yang pernah diikuti participant
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortPetitionParticipated($idParticipant, $table)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->orderByDesc('petition.' . $table)
            ->get();
    }

    //! Menampilkan petisi pernah diikuti participant sesuai kategori tertentu
    public function participatedPetitionByCategory($category, $idParticipant)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->where('petition.category', $category)
            ->get();
    }

    //! Menampilkan daftar petisi berdasarkan tipe event (berlangsung, menang, dll)
    public function listPetitionType($status)
    {
        return Petition::where('status', $status)->get();
    }

    //! Menampilkan daftar petisi yang pernah diikuti participant
    public function listPetitionParticipated($idParticipant)
    {
        return ParticipatePetition::where('idParticipant', $idParticipant)
            ->join('petition', 'participate_petition.idPetition', '=', 'petition.id')
            ->get();
    }

    //! Menampilkan daftar petisi yang dibuat oleh campaigner
    public function listPetitionByMe($idCampaigner)
    {
        return Petition::where('idCampaigner', $idCampaigner)->get();
    }

    //! Menampilkan seluruh daftar petisi yang sedang aktif
    public function indexPetition()
    {
        return Petition::where('status', 1)->get();
    }

    //! Menampilkan detail petisi tertentu berdasarkan ID
    public function showPetition($id)
    {
        return Petition::where('id', $id)->first();
    }

    //! Menampilkan komentar yang ada pada petisi tertentu berdasarkan ID
    public function commentsPetition($id)
    {
        return ParticipatePetition::where('idPetition', $id)
            ->join('users', 'participate_petition.idParticipant', '=', 'users.id')
            ->get();
    }

    //! Menampilkan berita perkembangan yang ada pada petisi tertentu berdasarkan ID
    public function newsPetition($id)
    {
        return UpdateNews::where('idPetition', $id)->get();
    }

    //! Menyimpan data berita perkembangan yang dibuat oleh campaigner
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

    //! Menyimpan data event petisi yang dibuat oleh campaigner
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

    //! Menyimpan data participant yang berpartisipasi pada petisi tertentu
    public function signPetition($petition)
    {
        return ParticipatePetition::create([
            'idPetition' => $petition->idPetition,
            'idParticipant' => $petition->idParticipant,
            'comment' => $petition->comment,
            'created_at' => Carbon::now()->format('Y-m-d')
        ]);
    }

    //! Mengambil jumlah total tandatangan petisi tertentu saat itu
    public function calculatedSign($idEvent)
    {
        return ParticipatePetition::where('idPetition', $idEvent)->count();
    }

    //! Update jumlah tandatangan petisi tertentu
    public function updateCalculatedSign($idEvent, $count)
    {
        return Petition::where('id', $idEvent)->update([
            'signedCollected' => $count
        ]);
    }
}
