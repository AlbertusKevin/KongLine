<?php

namespace App\Domain\Communication\Service;

use App\Domain\Admin\Entity\CommentForum;
use App\Domain\Communication\Dao\CommunicationDao;
use App\Domain\Communication\Entity\ForumLike;
use App\Domain\Communication\Entity\Service;

class CommunicationService
{

    private $dao;

    public function __construct()
    {
        $this->dao = new CommunicationDao();
    }

    public function findAdmin()
    {
        return $this->dao->getAdmin();
    }

    public function findMessageReceiver($id)
    {
        return $this->dao->getMessageReceiver($id);
    }

    public function findUserbyId($user_id)
    {
        return $this->dao->getUserbyId($user_id);
    }

    public function saveService(Service $message)
    {
        return $this->dao->saveService($message);
    }

    public function newMessage()
    {
        return $this->dao->newMessage();
    }

    public function userService($user_id)
    {
        return $this->dao->userService($user_id);
    }

    public function findAllForum()
    {
        return $this->dao->getAllForum();
    }

    public function findForumbyId($id)
    {
        return $this->dao->getForumbyId($id);
    }

    public function newLike()
    {
        return $this->dao->newLike();
    }

    public function saveLike(ForumLike $like)
    {
        return $this->dao->saveLike($like);
    }

    public function findLikeBy($idForum, $userid)
    {
        return $this->dao->getLikeby($idForum, $userid);
    }

    public function delLike(ForumLike $like)
    {
        return $this->dao->deleteLike($like);
    }

    public function saveComment(CommentForum $comment)
    {
        return $this->dao->saveComment($comment);
    }

    public function newComment()
    {
        return $this->dao->newComment();
    }

}