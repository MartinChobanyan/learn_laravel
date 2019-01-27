<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    public function command(){
        return $this->belongsTo('App\Command', 'id', 'command_id'); // 'his key'(in his table), that will be compared with 'my key'(in my table)
    }

    protected $guarded = [];
    protected $table = 'Players';
}
