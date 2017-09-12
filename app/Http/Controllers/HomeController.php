<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostType;
use Auth;
use Validator;
use App\Http\Requests\PostRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'index',
            'showPost',
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $posts = Post::with('postType')->orderBy('created_at', 'desc')->get();
        $posts = Post::with('postType')->orderBy('created_at', 'desc')->paginate(5);
        // $request->session()->flash('test', 132);
        // $request->session()->put('test', 132);
        // $request->session()->forget('test', 132);
        // $request->session()->flush('test', 132);

        return view('home', [
            'posts' => $posts,
        ]);
    }

    public function showCreateForm(Request $request)
    {
        $post_types = PostType::orderBy('name', 'asc')->get();
        return view('create_post', [
            'post_types' => $post_types,
        ]);
    }

    public function create(PostRequest $request)
    {
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'title' => 'required|string',
        //         'content' => 'required|string',
        //     ],
        //     [
        //         'required' => ':attribute 不可空白',
        //     ]
        // );
        // if ($validator->fails()) {
            // $request->flash();
        //     return back()->withInput()->withErrors($validator);
        // }
        $post = new Post($request->all());
        $post->user_id = Auth::user()->id;

        try {
            $post->save();
            return redirect()->route('home')->with('status', 'post created!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('home')->with('status', 'post failed!');
        }
    }

    public function destroy(Request $request)
    {
        $posts = Post::get();

        return view('home', [
            'posts' => $posts,
        ]);
    }

    public function edit(Request $request)
    {
        $posts = Post::get();

        return view('home', [
            'posts' => $posts,
        ]);
    }

    public function showPost($postId, Request $request)
    {
        // $post = Post::with('auther')->with('postType')->find($postId);
        $post = Post::with('auther')->with('postType')->findOrFail($postId);

        return view('show_post', [
            'post' => $post,
        ]);
    }
}
