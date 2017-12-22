<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostType;
use App\Comment;
use Auth;
use Validator;
use DB;
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
        // $this->middleware(['auth', 'admin'], ['except' => [
        //     'index',
        //     'showPost',
        // ]]);
        $this->middleware(['auth'], ['except' => [
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
        DB::enableQueryLog();

        $type_id = $request->query('type');
        // $posts = Post::join('post_types', 'posts.type', '=', 'post_types.id')->orderBy('created_at', 'desc')->paginate(5);
        // $posts = Post::with('postType')->orderBy('created_at', 'desc')->get();
        if ($type_id) {
            $posts = Post::with('postType')->where('type', $type_id)->orderBy('created_at', 'desc')->paginate(5);
        } else {
            $posts = Post::with('postType')->orderBy('created_at', 'desc')->paginate(5);
        }
        $post_types = PostType::orderBy('name', 'asc')->get();
        $type = null;
        if ($type_id) {
            $type = PostType::findOrFail($type_id);
        }
        $sql = Post::with('postType')->orderBy('created_at', 'desc')->toSql();
        // $request->session()->flash('test', 132);
        // $request->session()->put('test', 132);
        // $request->session()->forget('test', 132);
        // $request->session()->flush('test', 132);

        return view('home', [
            'posts' => $posts,
            'post_types' => $post_types,
            'type' => $type,
            'sql' => $sql,
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

    public function destroy($postId, Request $request)
    {
        $post = Post::findOrFail($postId);
        if (!Auth::user()->isAdminOrOwner($post->user_id)) {
            return response('Unauthorized.', 401);
        }
        $post->delete();

        return redirect()->route('home')->with(['status' => 'post deleted!']);
    }

    public function edit($postId, Request $request)
    {
        $post = Post::with('author')->with('postType')->findOrFail($postId);
        $post_types = PostType::orderBy('name', 'asc')->get();

        return view('show_post_edit', [
            'post' => $post,
            'post_types' => $post_types,
        ]);
    }

    public function update($postId, PostRequest $request)
    {
        $post = Post::findOrFail($postId);
        $post->fill($request->all());
        $post->save();

        return redirect()->route('home')->with(['status' => 'post updated!']);;
    }

    public function showPost($postId, Request $request)
    {
        // $post = Post::with('author')->with('postType')->find($postId);
        $post = Post::with('author')->with('postType')->findOrFail($postId);
        $comments = Comment::where('post_id', $postId)->with('author')->orderBy('created_at', 'DESC')->paginate(5);
        dump($post);
        dump($request->post);

        return view('show_post', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }
}
