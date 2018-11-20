<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
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
}
