<?php


namespace App\Repositories;

use App\Check;

class CheckRepository extends Repository
{
    public function __construct(Check $check)
    {
        $this->model = $check;
    }
}
