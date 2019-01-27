<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    //
    public function command(){
        return $this->hasOne('App\Command', 'stadium_id', 'id');
    }

    protected $guarded = [];
    protected $table = 'Stadiums';
}
