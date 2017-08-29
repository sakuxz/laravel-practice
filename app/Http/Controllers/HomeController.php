<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $posts = Post::get();
        // $posts = Post::paginate(5);
        // $request->session()->flash('test', 132);
        // $request->session()->put('test', 132);
        // $request->session()->forget('test', 132);
        // $request->session()->flush('test', 132);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
