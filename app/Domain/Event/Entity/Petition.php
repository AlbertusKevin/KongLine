<?php

namespace App\Domain\Event\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;
    protected $table = 'petition';
    protected $guarded = ['id'];
    public $timestamps = false;
}
