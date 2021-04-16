<?php

namespace App\Domain\Communication\Entity;

use App\Domain\Communication\Entity\Forum;
use App\Domain\Event\Entity\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumLike extends Model
{
    use HasFactory;
    protected $table = 'forum_like';
    protected $fillable = ['idForum', 'idParticipant', 'created_at'];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
