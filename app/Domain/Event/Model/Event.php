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
        $created_at;
}
