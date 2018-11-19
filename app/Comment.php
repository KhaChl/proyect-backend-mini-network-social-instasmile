<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    // Relacion muchos a uno con (muchos comentarios pueden pertenecer a 1 usuario)
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    // Relacion muchos a uno con (muchos comentarios pueden pertenecer a 1 imagen)
    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
}
