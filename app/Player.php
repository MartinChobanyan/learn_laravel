<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    public function command(){
        return $this->belongsTo('App\Command');
    }

    protected $guarded = [];
    protected $table = 'Players';
}
