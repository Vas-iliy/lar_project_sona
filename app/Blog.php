<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function images() {
        return $this->hasMany('App\Image');
    }

    public function informs() {
        return $this->hasMany('App\Inform');
    }

    public function filters() {
        return $this->hasMany('App\Filter');
    }
}
