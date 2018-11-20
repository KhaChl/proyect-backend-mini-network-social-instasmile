<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $table = 'likes';

     // Many-to-one relationship with users (many likes may belong to 1 user)
     public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    // Many-to-one relationship with images (many likes can belong to 1 image)
    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
}
