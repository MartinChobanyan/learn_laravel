<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public function stadium(){
        return $this->belongsTo(Stadium::class, 'stadium_id', 'id');
    }
    public function players(){
        return $this->hasMany(Player::class, 'team_id', 'id');
    }

    protected $guarded = [];
    protected $hidden = ['secret'];
}
