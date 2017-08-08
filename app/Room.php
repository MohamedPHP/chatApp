<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function messages()
    {
        return $this->hasMany('App\Message', 'room_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function online()
    {
        return $this->hasMany('App\Online', 'room_id');
    }
}
