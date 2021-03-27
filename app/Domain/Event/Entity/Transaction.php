<?php

namespace App\Domain\Event\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    public $timestamps = false;
    protected $fillable = ['idDonation', 'idParticipant', 'accountNumber', 'nominal', 'annonymous_donate', 'repaymentPicture', 'bank', 'status', 'created_at'];
}
