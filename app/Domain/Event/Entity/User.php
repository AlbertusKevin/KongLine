<?php

namespace App\Domain\Event\Entity;

use App\Domain\Admin\Entity\CommentForum;
use App\Domain\Communication\Entity\Forum;
use App\Domain\Communication\Entity\ForumLike;
use App\Domain\Communication\Entity\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function message()
    {
        return $this->hasMany(Service::class);
    }

    public function forums()
    {
        return $this->hasMany(Forum::class, 'idParticipant');
    }

    public function comments()
    {
        return $this->hasMany(CommentForum::class, 'idParticipant');
    }

    public function likes()
    {
        return $this->hasMany(ForumLike::class, 'idParticipant');
    }
}
