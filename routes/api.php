<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/post', function (Request $request) {
    // return App\Post::where('user_id', auth()->user()->id)->get();
    return App\Post::where('user_id', auth()->user()->id)->with('author')->paginate();
});

// in front-end
// fetch('/api/post?api_token=qLEkmmCjebNgaxvv75URI8yAlTyVOjev0dnalvJvFpw6jRJ7CZ55E3bvcmkK').then(e=>e.json()).then(e => { console.log(e); });