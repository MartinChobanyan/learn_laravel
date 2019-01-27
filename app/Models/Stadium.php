<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    //
    public function team(){
        return $this->hasOne(Team::class);
    }

    protected $guarded = [];
    protected $table = 'stadiums';
    protected $hidden = ['secret'];
}
