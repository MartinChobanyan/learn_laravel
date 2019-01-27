<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    public function command(){
        // BelongsTo
    }

    protected $guarded = [];
    protected $table = 'Players';
}
