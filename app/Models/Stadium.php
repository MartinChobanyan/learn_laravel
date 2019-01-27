<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    //
    public function team(){
        return $this->hasOne('App\Models\Team', 'stadium_id', 'id');
    }

    protected $guarded = [];
    protected $table = 'stadiums';
}
