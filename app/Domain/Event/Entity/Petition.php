<?php

namespace App\Domain\Event\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petition extends Event
{
    // konfigurasi ORM
    use HasFactory;
    protected $table = 'petition';
    public $timestamps = false;

    //attribute
    private $signedCollected;
    private $signedTarget;
    private $targetPerson;

    // Relasi
    public function participatepetition()
    {
        return $this->hasMany(ParticipatePetition::class);
    }

    public function updatenews()
    {
        return $this->hasMany(UpdateNews::class);
    }
}
