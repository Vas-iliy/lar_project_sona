<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    protected $fillable = ['name', 'email', 'phone'];
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function rooms() {
        return $this->belongsToMany('App\Room');
    }

    public function ratings() {
        return $this->belongsToMany('App\Rating');
    }

    public function checks() {
        return $this->hasMany('App\Check');
    }
}
