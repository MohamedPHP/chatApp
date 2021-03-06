<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function messages()
    {
        return $this->hasMany('App\Message', 'user_id');
    }
    public function rooms()
    {
        return $this->hasMany('App\Room', 'user_id');
    }

    public function online()
    {
        return $this->hasOne('App\User', 'user_id');
    }

}
