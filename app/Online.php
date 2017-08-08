<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    protected $table = 'online_users';


    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function rooms()
    {
        return $this->belongsTo('App\Room', 'room_id');
    }


}
