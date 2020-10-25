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

    public function arrChange($array) {
        $newArray = [];
        foreach ($array as $k => $arr) {
            if ($arr->position) {
                $k = $arr->position;
            }
            $newArray = Arr::add($newArray, $k, $arr);
        }

        return $newArray;
    }

    public function insert($atr) {
        $result = $this->model->fill($atr);

        return $result->save();
    }

    public function transliterate($string) {
        $str = mb_strtolower($string);
        $later_array = [
            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'j',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'x',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh',

            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'\'',

            'э' => 'e\'',   'ю' => 'yu',  'я' => 'ya',
        ];
        foreach ($later_array as $kyr => $later) {
            $str = str_replace($kyr, $later, $str);
        }
        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);
        $str = trim($str, '-');

        return $str;
    }
}
