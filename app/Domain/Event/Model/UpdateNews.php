<?php

namespace App\Domain\Event\Model;

class UpdateNews
{
    private $id, $idPetition, $title, $content, $link, $image, $created_at;

    public function __construct($idPetition, $title, $content, $link, $image, $created_at)
    {
        $this->idPetition = $idPetition;
        $this->title = $title;
        $this->content = $content;
        $this->link = $link;
        $this->image = $image;
        $this->created_at = $created_at;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getIdPetition()
    {
        return $this->idPetition;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getImage()
    {
        return $this->image;
    }
}
