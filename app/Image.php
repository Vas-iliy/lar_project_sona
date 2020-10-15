<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function page() {
        return $this->belongsTo('App\Page');
    }

    public function blog() {
        return $this->belongsTo('App\Blog');
    }
}
