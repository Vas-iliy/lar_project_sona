<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function page() {
        return $this->hasOne('App\Page');
    }

    public function rooms() {
        return $this->hasMany('App\Room');
    }
}
