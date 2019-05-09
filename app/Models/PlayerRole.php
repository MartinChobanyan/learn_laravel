<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PLayerRole extends Model
{
    //
    public function players(){
        return $this->hasMany(Player::class, 'role_id', 'id');
    }

    protected $table = 'players_roles';
    protected $fillable = ['role'];
}
