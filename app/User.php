<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fact() {
        return $this->hasOne('App\Fact');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function roles() {
        return $this->belongsToMany('App\Role');
    }

    public function canDo($permission) {
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $perm) {
                if (Str::is($perm, $permission)) {
                    return true;
                }
            }
        }
        return false;
    }
}
