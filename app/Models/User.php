<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function posts(){
        return $this->hasMany(Post::class, 'author_id', 'id');
    }

    public function getRolesAttribute(){
        return explode(',', $this->attributes['roles']);
    }

    public function hasRole($role){
        return in_array($role, $this->roles);
    }

    public function setRolesAttribute($roles){
        $this->attributes['roles'] = implode(',', $roles);
    }
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'skype', 'roles', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
