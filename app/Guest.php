<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public function rooms() {
        return $this->belongsToMany('App\Room');
    }
}
