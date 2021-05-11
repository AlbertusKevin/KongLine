<?php

namespace App\Domain\Donation\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = ['idDonation', 'idParticipant', 'accountNumber', 'nominal', 'annonymous_donate', 'repaymentPicture', 'status'];

    public function donations()
    {
        return $this->belongsTo(Donation::class, 'idDonation');
    }
}
