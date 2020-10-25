<?php


namespace App\Repositories;

use App\User;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function one($select, $where)
    {
        $user = parent::one($select, $where); // TODO: Change the autogenerated stub
        $user->load('fact');
        $user->fact->load('rooms');

        return $user;
    }

}
