<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    //
    public function stadium(){
        // hasMany
    }
    public function player(){
        // hasMany
    }

    protected $guarded = [];
    protected $table = 'Commands';
}
