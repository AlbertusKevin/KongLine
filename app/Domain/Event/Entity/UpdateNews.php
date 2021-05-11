<?php

namespace App\Domain\Event\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateNews extends Model
{
    use HasFactory;
    protected $table = 'update_news';
    protected $guarded = ['id'];
    public $timestamps = false;
}
