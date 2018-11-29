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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/account/config', 'UserController@config')->name('config');
    
    Route::post('/acount/edit', 'UserController@updateConfig')->name('account.edit');

    Route::post('/account/password/change', 'UserController@updatePassword')->name('account.password.change');

    Route::get('/account/avatar/{filename}', 'UserController@getImage')->name('account.avatar');

    Route::get('/profile/{id}', 'UserController@profile')->name('profile');
    
    Route::get('/create/publication', 'ImageController@create')->name('create.publication');

    Route::post('/save/publication', 'ImageController@save')->name('save.publication');

    Route::get('/publication/image/{filename}', 'ImageController@getImage')->name('publication.image');

    Route::post('/save/comment', 'CommentController@save')->name('save.comment');

    Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

    Route::get('/like/{image_id}', 'LikeController@like')->name('like');

    Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('dislike');


});

