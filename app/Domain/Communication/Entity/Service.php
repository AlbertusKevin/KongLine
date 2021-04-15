<?php

namespace App\Domain\Communication\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'service';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('\App\Domain\Event\Entity\User');
    }
}
