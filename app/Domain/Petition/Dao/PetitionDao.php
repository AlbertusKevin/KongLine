<?php

namespace App\Domain\Petition\Dao;

use App\Domain\Petition\Entity\ParticipatePetition;
use App\Domain\Petition\Entity\Petition;
use App\Domain\Petition\Entity\UpdateNews;

class PetitionDao
{
    public function deadlinePetition($id, $data)
    {
        Petition::where('id', $id)->update([
            'stack' => $data['stack'],
            'updated_at' => $data['updated_at'],
            'deadline' => $data['deadline'],
            'signedTarget' => $data['signedTarget']
        ]);
    }

    public function getAllPetition()
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->get();
    }

    //! Menampilkan seluruh daftar petisi yang sedang aktif
    public function getActivePetition()
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('status', ACTIVE)
            ->get();
    }

    //! Menampilkan detail petisi tertentu berdasarkan ID
    public function getDetailPetition($id)
    {
        return Petition::where('id', $id)->first();
    }

    //! Menampilkan komentar yang ada pada petisi tertentu berdasarkan ID
    public function getCommentsCertainPetition($id)
    {
        return ParticipatePetition::where('idPetition', $id)
            ->join('users', 'participate_petition.idParticipant', '=', 'users.id')
            ->get();
    }

    //! Menampilkan berita perkembangan yang ada pada petisi tertentu berdasarkan ID
    public function getProgressCertainPetition($id)
    {
        return UpdateNews::where('idPetition', $id)->where('deleted', '!=', 1)->get();
    }

    //! Menyimpan data berita perkembangan yang dibuat oleh campaigner
    public function saveProgressPetition($updateNews)
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

    public function updateProgressPetition($data)
    {
        UpdateNews::where('id', $data['idNews'])->update([
            'idPetition' => $data['idPetition'],
            'image' => $data['image'],
            'title' => $data['title'],
            'content' => $data['content'],
            'link' => $data['link'],
            'updated_at' => $data['updated_at']
        ]);
    }

    public function deleteProgressPetition($idNews, $updated_at)
    {
        UpdateNews::where('id', $idNews)->update([
            'updated_at' => $updated_at,
            'deleted' => 1
        ]);
    }

    public function getDetailNewsProgress($idNews)
    {
        return UpdateNews::where('id', $idNews)->first();
    }

    //! Menyimpan data event petisi yang dibuat oleh campaigner
    public function saveDataEventPetition($petition)
    {
        Petition::create([
            'idCampaigner' => $petition->getIdCampaigner(),
            'title' => $petition->getTitle(),
            'photo' => $petition->getPhoto(),
            'category' => $petition->getCategory(),
            'purpose' => $petition->getPurpose(),
            'status' => $petition->getStatus(),
            'created_at' => $petition->getCreatedAt(),
            'updated_at' => $petition->getUpdatedAt(),
            'signedCollected' => $petition->getSignedCollected(),
            'signedTarget' => $petition->getSignedTarget(),
            'targetPerson' => $petition->getTargetPerson(),
            'stack' => 0
        ]);
    }

    //! Menyimpan data event petisi yang dibuat oleh campaigner
    public function updatePetition($petition, $id)
    {
        Petition::where('id', $id)->update([
            'idCampaigner' => $petition->getIdCampaigner(),
            'title' => $petition->getTitle(),
            'photo' => $petition->getPhoto(),
            'category' => $petition->getCategory(),
            'purpose' => $petition->getPurpose(),
            'status' => $petition->getStatus(),
            'created_at' => $petition->getCreatedAt(),
            'updated_at' => $petition->getUpdatedAt(),
            'signedCollected' => $petition->getSignedCollected(),
            'signedTarget' => $petition->getSignedTarget(),
            'targetPerson' => $petition->getTargetPerson()
        ]);
    }

    //! Menyimpan data participant yang berpartisipasi pada petisi tertentu
    public function signedThePetition($petition)
    {
        return ParticipatePetition::create([
            'idPetition' => $petition->getIdPetition(),
            'idParticipant' => $petition->getIdParticipant(),
            'comment' => $petition->getComment(),
            'created_at' => $petition->getCreatedAt()
        ]);
    }

    //! Mengambil jumlah total tandatangan petisi tertentu saat itu
    public function getCalculatedSignedPetition($idEvent)
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

    //*
    //* Search, Sort, dan By Category
    //*

    //! Mencari petisi sesuai dengan
    //! status (berdasarkan tipe petisi) dan keyword tertentu
    public function searchPetition($status, $keyword)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.status', $status)
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
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
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.status', $status)
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->orderByDesc($table)
            ->get();
    }

    //! Mencari petisi sesuai dengan
    //! keyword dan kategori tertentu
    public function searchPetitionCategory($status, $keyword, $category)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.status', $status)
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->get();;
    }

    //! Mencari petisi sesuai dengan
    //! keyword dan sorting desc tertentu
    public function searchPetitionSortBy($status, $keyword, $table)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.status', $status)
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();;
    }

    public function searchAllPetition($keyword)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function searchAllPetitionCategorySort($status, $keyword, $category, $table)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->orderByDesc($table)
            ->get();
    }

    public function searchAllPetitionCategory($status, $keyword, $category)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->where('petition.category', $category)
            ->get();;
    }

    public function searchAllPetitionSortBy($status, $keyword, $table)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.title', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc($table)
            ->get();;
    }

    //! Mengurutkan petisi sesuai dengan
    //! sorting desc dan kategori tertentu
    public function sortPetitionCategory($category, $status, $table)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.status', $status)
            ->where('petition.category', $category)
            ->orderByDesc($table)
            ->get();
    }

    public function allStatusSortPetitionCategory($category, $table)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->where('category', $category)
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    public function allStatusSortPetition($table)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->orderByDesc($table)
            ->get();
    }

    public function allStatusPetitionByCategory($category)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->where('category', $category)
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->get();
    }

    //! Mengurutkan petisi dengan status tertentu
    //! secara descending sesuai dengan ketentuan yang dipilih
    public function sortPetition($status, $table)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.status', $status)
            ->orderByDesc($table)
            ->get();
    }

    //! Menampilkan petisi dengan status tertentu sesuai kategori tertentu
    public function petitionByCategory($category, $status)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.status', $status)
            ->where('petition.category', $category)
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
    public function getListPetitionByStatus($status)
    {
        return Petition::selectRaw('petition.*, category.description as category, event_status.description as status')
            ->join('category', 'petition.category', 'category.id')
            ->join('event_status', 'petition.status', 'event_status.id')
            ->where('petition.status', $status)
            ->get();
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
}
