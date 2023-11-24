<?php

namespace App\Services;

use App\Dao\CommentDao;

class CommentService
{
    public function __construct(CommentDao $commentDao)
    {
        $this->commentDao = $commentDao;
    }

    public function saveComment($request)
    {
        $comment = $this->commentDao->saveComment($request);
        return $comment;
    }

    public function getCommentById($id)
    {
        $comment = $this->commentDao->getCommentById($id);
        return $comment;
    }

    public function updateComment($request, $id)
    {
        $comment = $this->commentDao->updateComment($request, $id);
        return $comment;
    }

    public function deleteComment($id)
    {
        $comment = $this->commentDao->deleteComment($id);
        return $comment;
    }

}
