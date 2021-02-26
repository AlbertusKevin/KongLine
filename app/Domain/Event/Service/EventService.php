<?php

namespace App\Domain\Event\Service;

use App\Domain\Event\Dao\EventDao;

class EventService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new EventDao();
    }

    private function upload_image($img, $folder)
    {
        $pictName = $img->getClientOriginalName();
        //ambil ekstensi file
        $pictName = explode('.', $pictName);
        //buat nama baru yang unique
        $pictName = uniqid() . '.' . end($pictName); //7dsf83hd.jpg
        //upload file ke folder yang disediakan
        $targetUploadDesc = "images\\profile\\" . $folder . "\\";
        $img->move($targetUploadDesc, $pictName);

        return $targetUploadDesc . "\\" . $pictName;   //membuat file path yang akan digunakan sebagai src html
    }

    //? ===================================================================
    //! Profile Service
    //? ===================================================================

    public function editProfile($id)
    {
        return $this->dao->showProfile($id);
    }

    public function updateProfile($request, $id)
    {
        $pathProfile = $this->upload_image($request->file('profile_picture'), 'photo');
        $pathBackground = $this->upload_image($request->file('zoom_picture'), 'background');
        $this->dao->updateProfile($request, $id, $pathProfile, $pathBackground);
    }

    //? ===================================================================
    //! ~~~~~~~~~~~~~~~~~~~~~~~~~ Petition Service ~~~~~~~~~~~~~~~~~~~~~~~~
    //? ===================================================================

    public function indexPetition()
    {
        return $this->dao->indexPetition();
    }

    public function listPetitionType($request)
    {
        $userId = $this->showProfile($request->session()->get('id_user'));
        $userId = $userId->id;

        if ($request->typePetition == "berlangsung") {
            return $this->dao->listPetitionType(1);
        }

        if ($request->typePetition == "menang") {
            return $this->dao->listPetitionType(2);
        }

        if ($request->typePetition == "partisipasi") {
            return $this->dao->listPetitionParticipated($userId);
        }

        return $this->dao->listPetitionByMe($userId);
    }

    public function showPetition($id)
    {
        return $this->dao->showPetition($id);
    }

    public function checkParticipated($idEvent, $idParticipant, $typeEvent)
    {
        $isInList = $this->dao->checkParticipated($idEvent, $idParticipant, $typeEvent);
        return empty($isInList);
    }


    //? ===================================================================
    //! ~~~~~~~~~~~~~~~~~~~~~~~~~ Dummy Service ~~~~~~~~~~~~~~~~~~~~~~~~
    //? ===================================================================
    public function showProfile($id)
    {
        return $this->dao->showProfile($id);
    }
}
