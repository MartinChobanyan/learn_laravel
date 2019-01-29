<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function players(){
        return $this->belongsToMany(Player::class);
    }

    protected $fillable = ['role'];
}
