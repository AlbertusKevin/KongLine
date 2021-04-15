<?php

namespace App\Domain\Admin\Entity;

use App\Domain\Communication\Entity\Forum;
use App\Domain\Event\Entity\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentForum extends Model
{
    use HasFactory;
    protected $table = 'comment_forum';
    protected $guarded = ['id'];
    protected $fillable = ['idForum','idParticipant','content','updated_at', 'created_at'];

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'idForum');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idParticipant');
    }
}
