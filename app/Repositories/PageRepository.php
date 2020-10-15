<?php


namespace App\Repositories;


use App\Page;

class PageRepository extends Repository
{
    public function __construct(Page $page)
    {
        $this->model = $page;
    }
}
