<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    // Many-to-one relationship with users (many comments may belong to 1 user)
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    // Many-to-one relationship with images (many comments may belong to 1 image)
    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
}
