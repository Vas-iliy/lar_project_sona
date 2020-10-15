<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function images() {
        return $this->hasMany('App\Image');
    }

    public function texts() {
        return $this->hasMany('App\Text');
    }

    public function services() {
        return $this->hasMany('App\Service');
    }
}
