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
Route::post('/create', 'HomeController@create');
Route::put('/update/{id}', 'HomeController@update')->name('home.update');
Route::delete('/destroy/{post}', 'HomeController@destroy')->name('home.destroy');

Route::resource('type', 'PostTypeController',
                ['except' => ['index', 'show']]);
