<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function pages() {
        return $this->belongsTo('App\Page');
    }

    public function rooms() {
        return $this->belongsToMany('App\Room');
    }
}
