@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="page-header">
                @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->id === $post->user_id))
                    <form class="pull-right" method="POST" action="{{ route('home.destroy', ['post' => $post->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <a class="btn btn-xs btn-primary" href="{{ route('home.edit', ['post' => $post->id]) }}">
                            編輯
                        </a>
                        <button class="btn btn-xs btn-danger" type="submit">
                            刪除
                        </button>
                    </form>
                @endif
                <h1>{{ $post->title }}</h1>
                <span class="pull-right">{{ $post->created_at }}</span>
                <span>{{ $post->author->name }}</span>
                @if($post->postType)
                    <span class="badge">{{ $post->postType->name }}</span>
                @endif
            </div>

            <div>
                {{ $post->content }}
            </div>
            <div class="panel panel-default" style="margin-top: 2.5em;">
                <div class="panel-heading">留言 ({{ $comments->count() }})</div>
                <div class="panel-body">
                    
                    @if (Auth::check())
                        <form method="post" action="{{ route('post.comment.store', ['post' => $post->id]) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>名稱</label>
                                <p>
                                {{ Auth::user()->name }}
                                </p>
                            </div>
                            <label for="content">回應</label>
                            <div class="form-group">
                                <textarea id="content" class="form-control" name="content" rows="5"></textarea>
                            </div>
                            <input class="btn btn-primary" type="submit" value="發表">
                        </form>

                    <hr>
                    
                    @endif

                    @foreach ($comments as $comment)
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" style="width: 55px;" src="https://is5-ssl.mzstatic.com/image/thumb/Purple71/v4/40/8c/4a/408c4a16-8566-d99a-7171-38d69756e71e/iMessage_App_Icon-1x_U007emarketing-0-0-GLES2_U002c0-512MB-sRGB-0-0-0-85-181-0-0-0-0.png/266x200bb.jpeg" alt="avatar">
                                </a>
                            </div>
                            <div class="media-body">
                                <span style="float: right;">{{ $comment->created_at }}</span>                                
                                <h4 class="media-heading">{{ $comment->author->name }}</h4>
                                {{ $comment->content }}
                            </div>
                            <div class="media-right">
                                @if (Auth::check() && (Auth::user()->isAdmin() || $comment->user_id === Auth::user()->id)) 
                                    <form method="post" action="{{ route('post.comment.destroy', ['post' => $post->id, 'comment' => $comment->id]) }}">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <input class="btn btn-danger" type="submit" value="刪除">
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{ $comments->render() }}
                </div>
            </div>

        </div>
    </div>
    
</div>
@endsection

