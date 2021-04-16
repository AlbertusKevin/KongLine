<?php

namespace App\Domain\Communication\Dao;

use App\Domain\Admin\Entity\CommentForum;
use App\Domain\Communication\Entity\Forum;
use App\Domain\Communication\Entity\ForumLike;
use App\Domain\Event\Entity\User;
use App\Domain\Communication\Entity\Service;

class CommunicationDao
{

    public function getAdmin()
    {
        return User::where('role', 'admin')->first();
    }

    public function getMessageReceiver($id)
    {
        return Service::where('user_id', $id)->orWhere('receiver', $id)->orderBy('id', 'DESC')->get();
    }

    public function getUserbyId($user_id)
    {
        return User::find($user_id);
    }

    public function saveService(Service $message)
    {
        return $message->save();
    }

    public function newMessage()
    {
        return new Service();
    }

    public function userService($user_id)
    {
        return Service::where('user_id', $user_id)->get();
    }

    public function getAllForum()
    {
        return Forum::all();
    }

    public function getForumbyId($id)
    {
        return Forum::find($id);
    }

    public function newLike()
    {
        return new ForumLike();
    }

    public function saveLike(ForumLike $like)
    {
        return $like->save();
    }

    public function getLikeby($idForum, $userid)
    {
        return ForumLike::where('idForum','=', $idForum)->where('idParticipant','=',$userid);
    }

    public function deleteLike(ForumLike $like)
    {
        return $like->delete();
    }

    public function saveComment(CommentForum $comment)
    {
        return $comment->save();
    }

    public function newComment()
    {
        return new CommentForum();
    }

}