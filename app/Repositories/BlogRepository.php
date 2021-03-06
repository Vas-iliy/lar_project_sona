<?php


namespace App\Repositories;

use App\Blog;

class BlogRepository extends Repository
{
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    public function one($select, $where)
    {
        $blog = parent::one($select, $where); // TODO: Change the autogenerated stub
        $blog->load('images');
        $blog->load('informs');

        $blog->images = $this->arrChange($blog->images);
        $blog->informs = $this->arrChange($blog->informs);

        return $blog;
    }
}
