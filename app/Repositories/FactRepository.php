<?php


namespace App\Repositories;

use App\Fact;

class FactRepository extends Repository
{
    public function __construct(Fact $fact)
    {
        $this->model = $fact;
    }
}
