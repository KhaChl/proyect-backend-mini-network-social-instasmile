<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    // One to many relationship with comments.
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    // One-to-many relationship with likes.
    public function likes(){
        return $this->hasMany('App\Like');
    }

    // Many-to-one relationship with users(many images may belong to 1 user)
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }




}
