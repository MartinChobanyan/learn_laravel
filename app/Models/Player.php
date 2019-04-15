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
        return $this->belongsTo(Role::class);
    }

    protected $fillable = ['name', 'nick', 'team_id', 'secret', 'contract'];
    protected $hidden = ['secret'];
}
