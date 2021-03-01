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

    private function upload_image($img, $folder)
    {
        $pictName = $img->getClientOriginalName();
        //ambil ekstensi file
        $pictName = explode('.', $pictName);
        //buat nama baru yang unique
        $pictName = uniqid() . '.' . end($pictName); //7dsf83hd.jpg
        //upload file ke folder yang disediakan
        $targetUploadDesc = "images/profile/" . $folder . "/";
        $img->move($targetUploadDesc, $pictName);

        return $targetUploadDesc . "/" . $pictName;   //membuat file path yang akan digunakan sebagai src html
    }
}
