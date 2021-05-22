<?php

namespace App\Domain\Donation\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Profile\Entity\User;

class Donation extends Model
{
    // Konfigurasi ORM
    use HasFactory;
    protected $table = 'donation';
    protected $guarded = ['id'];

    // Relasi
    public function detailallocation()
    {
        return $this->hasMany(DetailAllocation::class);
    }

    public function participatedonation()
    {
        return $this->hasMany(ParticipateDonation::class, 'id', 'idDonation');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'idCampaigner', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'idDonation', 'id');
    }
}
