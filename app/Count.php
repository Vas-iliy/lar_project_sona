<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    public function rooms() {
        return $this->belongsToMany('App\Room');
    }
}
