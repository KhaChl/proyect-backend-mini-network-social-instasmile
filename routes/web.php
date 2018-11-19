<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use App\Image;

Route::get('/', function () {
    //Test ORM
    /*$images = Image::all();
    foreach($images as $image){
        echo $image->user->name.' '.$image->user->surname.'<br>';
        echo $image->image_path.'<br>';
        echo $image->description.'<br>';
        echo 'Likes: '. count($image->likes);
        if(count($image->comments) >= 1){
            echo '<p><strong>Comentarios</strong></p>';
            foreach ($image->comments as $comment) {
                echo $comment->user->name.' '.$image->user->surname.': '.$comment->content.'<br>';
            }
        }
        
        echo '<hr>';
    }
    die();
    return view('welcome');
    */
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/account/config', 'UserController@config')->name('config');
    
    Route::post('/acount/edit', 'UserController@updateConfig')->name('account.edit');

    Route::post('/account/password/change', 'UserController@updatePassword')->name('account.password.change');

    Route::get('/account/avatar/{filename}', 'UserController@getImage')->name('account.avatar');
    
    Route::get('/create/publication', 'ImageController@create')->name('create.publication');

    Route::post('/save/publication', 'ImageController@save')->name('save.publication');

});

