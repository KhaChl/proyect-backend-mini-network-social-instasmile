<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;
use Auth;

class ImageController extends Controller
{
    public function create(){
        return view('image.create');
    }

    public function save(Request $request){
        // Create object Image
        $image = new Image();
        // validate 
        $validatedData =  $request->validate([
            'description' => 'required',
            'image_publication' => 'required|image'
        ]);
        // Data input
        $user = Auth::user();
        $description = $request->input('description');
        $image_publication = $request->file('image_publication');
        // Update Image
        if ($image_publication) {

            // create instance
            $img = \Image::make($image_publication)->encode('jpg', 90);

            // put name unique image
            $image_publication_name = time().$image_publication->getClientOriginalName();

            // save image storage (storage/app/users)
            Storage::disk('images')->put($image_publication_name, $img);

            //Set object image
            $image->user_id = $user->id;
            $image->image_path = $image_publication_name;
            $image->description = $description;
            
            // Create publication
            if($image->save()){
                return redirect()->route('home')
                            ->with(['message-success'=>'Publicación creada']);
            }else {
                return redirect()->route('home')
                        ->with(['message-error'=>'Error al crear publicación']);
            }

        }else {
            return redirect()->route('home')
                        ->with(['message-error'=>'Error al guardar imagen']);
        }
        
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);

        return new Response($file,200);
    }

    public function publicationDelete($id){

        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if($user && $image && $image->user->id == $user->id){

            if($comments && $comments->count() >= 1){
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            if($likes && $likes->count() >= 1){
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            Storage::disk('images')->delete($image->image_path);

            if($image->delete()){
                return redirect()->route('profile', ['id' => $user->id])
                                ->with(['message-success'=>'Publicación eliminada']);
            }else {
                return redirect()->route('profile', ['id' => $user->id])
                                ->with(['message-error'=>'Error al eliminar publicacion']);
            } 
        }else {
            return redirect()->route('home');
        }
    }

}
