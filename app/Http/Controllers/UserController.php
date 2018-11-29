<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    
    public function config(){
        return view('user.config');
    }

    public function updateConfig(Request $request){
        // User identity
        $user = Auth::user();
        $id = $user->id;

        // validate 
        $validatedData =  $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'image_profile' => 'image'
        ]);

        // data update
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        // object user
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        // Update Image profile
        $image_profile = $request->file('image_profile');
        if ($image_profile) {

            // create instance
            $img = \Image::make($image_profile);

            // resize the image to a width of 400 and constrain aspect ratio (auto height)
            $img->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');;

            // put name unique image
            $image_profile_name = time().$image_profile->getClientOriginalName();

            // save image storage (storage/app/users)
            Storage::disk('users')->put($image_profile_name, $img);

            //object user
            $user->image_path = $image_profile_name;
        }
        // update user
        if($user->update()){
            return redirect()->route('config')
                        ->with(['message-success'=>'Usuario actualizado correctamente']);
        }else {
            return redirect()->route('config')
                        ->with(['message-error'=>'Error al actualizar usuario']);
        }

        
    }

    public function updatePassword(Request $request){
        // User identity
        $user = Auth::user();
        $pass = $user->password;


        // validate 
        $validatedData =  $request->validate([
            'password-current' => 'required|string|min:6',
            'password-new' => 'required|string|min:6|same:password_confirmation'
        ]);

        
        // data update
        $oldpassword = $request->input('password-current');
        $newpassword = $request->input('password-new');        

        // check password old
        if (Hash::check($oldpassword, $pass)) {

            // object user
            $user->password =  Hash::make($newpassword);;

            // update user
            if($user->update()){
                return redirect()->route('config')
                            ->with(['message-success-password'=>'Contraseña actualizada correctamente']);
            }else {
                return redirect()->route('config')
                            ->with(['message-error-password'=>'Error al actualizar contraseña']);
            }
        }else{
            return redirect()->route('config')
            ->with(['message-error-password'=>'Error contraseña incorrecta']);
        }


       
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);

        return new Response($file,200);
    }

    public function profile($id){

        $user = User::find($id);

        return view('user.profile', [
            'user' => $user
        ]);
    }
}
