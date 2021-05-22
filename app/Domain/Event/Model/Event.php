<?php

namespace App\Domain\Event\Model;

class Event
{
    // Attribute
    protected $id,
        $idCampaigner,
        $title,
        $photo,
        $category,
        $purpose,
        $deadline,
        $status,
        $created_at,
        $updated_at;

    public function __construct($idCampaigner, $title, $photo, $category, $purpose, $status, $created_at, $updated_at)
    {
        $this->idCampaigner = $idCampaigner;
        $this->title = $title;
        $this->photo = $photo;
        $this->category = $category;
        $this->purpose = $purpose;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    protected function setPhoto($img)
    {
        $this->photo = $img;
    }

    protected function getIdCampaigner()
    {
        return $this->idCampaigner;
    }

    protected function getTitle()
    {
        return $this->title;
    }

    protected function getPhoto()
    {
        return $this->photo;
    }

    protected function getCategory()
    {
        return $this->category;
    }

    protected function getPurpose()
    {
        return $this->purpose;
    }

    protected function getStatus()
    {
        return $this->status;
    }

    protected function getCreatedAt()
    {
        return $this->created_at;
    }

    protected function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
