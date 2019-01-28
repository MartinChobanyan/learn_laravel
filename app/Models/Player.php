<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    public function team(){
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    protected $guarded = [];
    protected $hidden = ['secret'];
}
