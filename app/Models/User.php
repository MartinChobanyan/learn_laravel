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
        return $this->attributes['roles'];
    }

    public function getPriorityAttribute(){
        $u_p = 0;
        foreach(explode(',', $this->roles) as $role){
            $p = array_search($role, User::$priority_list);
            if($u_p < $p) $u_p = $p;
        }
        return $u_p;
    }

    public function hasRole($role){
        return in_array(strtolower($role), array_map('strtolower', explode(',', $this->roles)));
    }

    public function setRole($role){
        $this->roles .= ','.$role;
    }

    public function deleteRole($role){
        $this->roles = str_replace(','.$role, '', $this->roles);
    }

    /**
     * The roles priority list by ASC.
     *
     * @var array
     */
    static $priority_list = [
        'user', 'manager', 'admin'
    ];

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
