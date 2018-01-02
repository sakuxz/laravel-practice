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

Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    // return $request->user();
    return auth()->user();
});

Route::get('/test_token', function (Request $request) {
    if (config('app.env') == 'local')
    {
        \Debugbar::disable();
    }

    $user = App\User::first();
    $token = JWTAuth::fromUser($user);
    return response()->json(compact('token'));
});

// front-end
// fetch('/api/test_token').then(e => e.json()).then(e => { console.log(e); });
// fetch('/api/user?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImlzcyI6Imh0dHA6Ly8xNzIuMTcuMTcuMTU5OjgwODAvYXBpL3Rlc3RfdG9rZW4iLCJpYXQiOjE1MTQ5MTM5NjQsImV4cCI6MTUxNDkxNzU2NCwibmJmIjoxNTE0OTEzOTY0LCJqdGkiOiJ4YUtTWEU1a3BPUjVGR3ZrIn0.23oGUTGuw4dLQytkZOl3GGkf5bIsFwJ2zd-bmPT7QPc').then(e => e.json()).then(e => { console.log(e); });