<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    public function team(){
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
    public function role(){
        return $this->belongsTo(PlayerRole::class, 'role_id', 'id');
    }

    protected $fillable = ['name', 'nick', 'role_id', 'team_id', 'contract'];
    protected $hidden = ['secret'];
}
