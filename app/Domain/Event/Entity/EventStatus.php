<?php

namespace App\Domain\Event\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStatus extends Model
{
    use HasFactory;
    protected $table = 'event_status';
    protected $fillable = ['id', 'description'];
    public $timestamps = false;
}
