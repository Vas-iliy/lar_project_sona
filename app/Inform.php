<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inform extends Model
{
    public function blog() {
        return $this->belongsTo('App\Blog');
    }
}
