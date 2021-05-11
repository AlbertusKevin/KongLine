<?php

namespace App\Domain\Petition\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipatePetition extends Model
{
    use HasFactory;
    protected $table = 'participate_petition';
    protected $fillable = ['idPetition', 'idParticipant', 'comment', 'created_at'];
    public $timestamps = false;
}
