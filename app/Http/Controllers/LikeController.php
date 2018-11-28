<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;

class LikeController extends Controller
{
    public function like($image_id){

        $user = Auth::user();

        $exist_like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->count();
        if($exist_like == 0){
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
            $like->save();
            
            return response()->json(['like' => $like]);
        }

        
    }

    public function dislike($image_id){

        $user = Auth::user();

        $like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->first();
        if($like){
            $like->delete();
            
            return response()->json(['like' => $like]);
        }
    }
}
