<?php


namespace App\Repositories;

use App\Social;

class SocialRepository extends Repository
{
    public function __construct(Social $social)
    {
        $this->model = $social;
    }
}
