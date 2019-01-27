<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    //
    public function stadium(){
        return $this->belongsTo('App\Stadium', 'id', 'stadium_id');
    }
    public function player(){
        return $this->hasMany('App\Player', 'command_id', 'id'); // 'his key'(in his table) that will be compared with 'my key'(in my table);
    }

    protected $guarded = [];
    protected $table = 'Commands';
}
