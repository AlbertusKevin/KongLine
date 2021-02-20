<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumLike extends Model
{
    use HasFactory;
    protected $table = 'forum_like';
    protected $fillable = ['idForum', 'idParticipant'];
}
