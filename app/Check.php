<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    public function room() {
        return $this->belongsTo('App\Room');
    }
}
