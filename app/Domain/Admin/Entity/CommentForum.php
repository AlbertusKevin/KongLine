<?php

namespace App\Domain\Admin\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentForum extends Model
{
    use HasFactory;
    protected $table = 'comment_forum';
    protected $guarded = ['id'];
}
