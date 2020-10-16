<?php


namespace App\Repositories;

use App\Comment;

class CommentRepository extends Repository
{
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}
