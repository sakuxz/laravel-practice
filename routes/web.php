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
Route::get('/create', 'HomeController@showCreateForm')->name('home.create');
Route::get('/show/{post}', 'HomeController@showPost')->name('home.show');
Route::get('/edit/{post}', 'HomeController@edit')->name('home.edit');
Route::post('/create', 'HomeController@create')->name('home.store');
Route::put('/update/{id}', 'HomeController@update')->name('home.update');
Route::delete('/destroy/{post}', 'HomeController@destroy')->name('home.destroy');

Route::resource('type', 'PostTypeController', ['except' => ['index', 'show']]);
Route::resource('post.comment', 'PostCommentController', ['only' => ['store', 'destroy']]);

Route::group(['prefix' => 'login', 'middleware'=>['guest']], function () {
    Route::get('{provider}/redirect', [
        'as' => 'social.redirect',
        'uses' => 'Auth\LoginController@redirectToProvider',
    ]);
    Route::get('{provider}/callback', [
        'as' => 'social.callback',
        'uses' => 'Auth\LoginController@handleProviderCallback',
    ]);
});
