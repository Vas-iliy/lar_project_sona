<?php


namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DbRepository extends Repository
{
    public function db($table, $atr) {
        DB::table($table)->insert($atr);
    }
}
