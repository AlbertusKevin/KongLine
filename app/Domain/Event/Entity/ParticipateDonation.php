<?php

namespace App\Domain\Event\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipateDonation extends Model
{
    use HasFactory;
    protected $table = 'participate_donation';
    protected $fillable = ['idDonation', 'idParticipant', 'comment', 'created_at', 'annonymous_comment'];
    public $timestamps = false;
}
