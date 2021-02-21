<?php

namespace App\Domain\Event\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAllocation extends Model
{
    use HasFactory;
    protected $table = 'detail_allocation';
    protected $guarded = 'id';
    public $timestamps = false;
}
