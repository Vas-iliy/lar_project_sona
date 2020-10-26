<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $fillable = ['check_in', 'check_out', 'room_id', 'count_id', 'fact_id'];

    public function room() {
        return $this->belongsTo('App\Room');
    }

    public function fact() {
        return $this->belongsTo('App\Fact');
    }
}
