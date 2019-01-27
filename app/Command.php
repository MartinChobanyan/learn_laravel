<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    //
    public function stadium(){
        return $this->belongsTo('App\Stadium');
    }
    public function player(){
        return $this->hasMany('App\Player', 'command_id', 'id');
    }

    protected $guarded = [];
    protected $table = 'Commands';
}
