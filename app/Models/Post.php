<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function author(){
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    protected $fillable=['author_id', 'photo', 'title', 'content'];
}