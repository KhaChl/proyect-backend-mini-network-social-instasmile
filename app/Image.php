<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    // Relacion uno a muchos con los comentarios
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    // Relacion uno a muchos con los likes
    public function likes(){
        return $this->hasMany('App\Like');
    }

    // Relacion muchos a uno con (muchas imagenes puden pertenecer a 1 usuario)
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }




}
