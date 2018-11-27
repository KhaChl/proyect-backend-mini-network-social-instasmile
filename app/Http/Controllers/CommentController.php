<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function save(Request $request){

        $validatedData =  $request->validate([
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);

        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        $comment->save();

        return redirect()->route('home');

    }

    public function delete($id){

        $user = Auth::user();
        $comment = Comment::find($id);

        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            return redirect()->route('home');
        }else {
            return redirect()->route('home')->with([
                'message' => 'Error al interntar eliminar comentario'
            ]);
        }

    }
}
