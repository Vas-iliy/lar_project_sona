<?php


namespace App\Repositories;


use Illuminate\Support\Arr;

class Repository
{
    protected $model;

    public function get($select = '*', $take = false, $where = false, $paginate = false)
    {
        $builder = $this->model->select($select);

        if ($take) {
            $builder->take($take);
        }

        if ($where && is_array($where)) {
            $builder->where($where[0], $where[1]);
        }

        if ($paginate) {
            return $builder->paginate($paginate);
        }

        return $builder->get();

    }

    public function one($select, $where)
    {
        return $builder = $this->model->select($select)->where($where[0], $where[1])->first();
    }
}
