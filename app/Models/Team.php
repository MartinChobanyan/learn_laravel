<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public function stadium(){
        return $this->belongsTo(Stadium::class);
    }
    public function player(){
        return $this->hasMany(Player::class, 'team_id', 'id'); // 'his key'(in his table) that will be compared with 'my key'(in my table);
    }

    protected $guarded = [];
}
