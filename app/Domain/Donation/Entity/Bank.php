<?php

namespace App\Domain\Donation\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'bank';
    protected $fillable = ['id', 'bank'];
    public $timestamps = false;
}
