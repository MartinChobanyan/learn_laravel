<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public function stadium(){
        return $this->belongsTo('App\Models\Stadium', 'id', 'stadium_id');
    }
    public function player(){
        return $this->hasMany('App\Models\Player', 'team_id', 'id'); // 'his key'(in his table) that will be compared with 'my key'(in my table);
    }

    protected $guarded = [];
}
