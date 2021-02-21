<?php

namespace App\Domain\Admin\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusUser extends Model
{
    use HasFactory;
    protected $table = 'status_user';
    protected $fillable = ['id', 'description'];
    public $timestamps = false;
}
