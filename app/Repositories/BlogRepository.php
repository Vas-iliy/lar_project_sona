<?php


namespace App\Repositories;

use App\Blog;

class BlogRepository extends Repository
{
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }
}
