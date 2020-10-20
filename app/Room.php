<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function services() {
        return $this->belongsToMany('App\Service');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function checks() {
        return $this->hasMany('App\Check');
    }

    public function counts() {
        return $this->belongsToMany('App\Count');
    }

    public function guests() {
        return $this->belongsToMany('App\Guest');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function facts() {
        return $this->belongsToMany('App\Fact');
    }
}
