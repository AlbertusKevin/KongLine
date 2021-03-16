<?php

namespace App\Domain\Event\Entity;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Attribute
    protected $id;
    protected $idCampaigner;
    protected
        $title,
        $photo,
        $category,
        $purpose,
        $deadline,
        $status,
        $created_at;

    // Relasi
    public function eventstatus()
    {
        return $this->belongsTo(EventStatus::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function campaigner()
    {
        return $this->belongsTo(Campaigner::class);
    }
}
