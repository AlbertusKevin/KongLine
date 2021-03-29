<?php

namespace App\Domain\Event\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    // Konfigurasi ORM
    use HasFactory;
    protected $table = 'donation';
    public $timestamps = false;
    protected $guarded = ['id'];

    // Relasi
    public function detailallocation()
    {
        return $this->hasMany(DetailAllocation::class);
    }

    public function participatedonation()
    {
        return $this->hasMany(ParticipateDonation::class);
    }
}
