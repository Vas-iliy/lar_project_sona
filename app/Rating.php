<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function facts() {
        return $this->belongsToMany('App\Fact');
    }
}
