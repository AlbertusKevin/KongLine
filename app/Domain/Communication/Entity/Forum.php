<?php

namespace App\Domain\Communication\Entity;

use App\Domain\Admin\Entity\CommentForum;
use App\Domain\Communication\Entity\ForumLike;
use App\Domain\Event\Entity\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;
    protected $table = 'forum';
    protected $guarded = ['id'];
    protected $fillable = ['idParticipant','content','title','created_at'];

    public $timestamps = false;

    public function comments()
    {
        return $this->hasMany(CommentForum::class, 'idForum')->orderBy('id','DESC');
    }

    public function likes()
    {
        return $this->hasMany(ForumLike::class, 'idForum');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idParticipant');
    }

}
