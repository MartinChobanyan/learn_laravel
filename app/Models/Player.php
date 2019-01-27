<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    public function team(){
        return $this->belongsTo(Team::class); // 'his key'(in his table), that will be compared with 'my key'(in my table)
    }

    protected $guarded = [];
}
