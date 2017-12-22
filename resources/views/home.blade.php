@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-8">
             @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif
            <h5 class="clearfix">
                @if(Auth::check())
                    <div class="pull-right">
                        <a href="{{ route('home.create') }}" class="btn btn-xs btn-default" style="margin-left: 2px;">
                            新增文章
                        </a>
                    </div>
                @endif
                @if(isset($type))
                    分類：{{ $type->name }}
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <form class="pull-right" action="{{ route('type.destroy', ['id' => $type->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" class="btn btn-xs btn-danger">刪除分類</button>
                            <a href="{{ route('type.edit', ['id' => $type->id]) }}" class="btn btn-xs btn-primary">編輯分類</a>
                        </form>
                    @endif
                @elseif(isset($keyword))
                    搜尋：{{ $keyword }}
                @else
                    所有文章
                @endif
            </h5>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-8">
            @if(count($posts) == 0)
                <div class="well">沒有任何文章</div>
            @endif
            @foreach($posts as $post)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $post->title }}
                        <!-- <pre>
                            {{ var_dump($post->postType) }}
                        </pre> -->
                        @if($post->postType != null)
                            <span class="badge">{{ $post->postType->name }}</span>
                        @endif
                        <div class="pull-right">
                            {{ $post->created_at->toDateString() }}
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (session('test'))
                            <div class="alert alert-success">
                                {{ session('test') }}
                            </div>
                        @endif
                        <!-- <p>{{ $post->content }}</p> -->
                        <div class="row">
                            
                            <div class="col-xs-8">
                                @if(Auth::check() && Auth::user()->isAdminOrOwner($post->user_id))
                                    <form method="POST" action="{{ route('home.destroy', ['post' => $post->id]) }}">
                                        <a class="btn btn-xs btn-primary" href="{{ route('home.edit', ['post' => $post->id]) }}">
                                            編輯
                                        </a>
                                        <button class="btn btn-xs btn-danger" type="submit">
                                            刪除
                                        </button>
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                @endif
                            </div>
                            <div class="col-xs-4">
                                <a class="pull-right" href="{{ route('home.show', ['post' => $post->id]) }}">
                                    繼續閱讀...
                                </a>
                            </div>

                            
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="col-md-4">
            <div class="list-group">
                <a class="list-group-item {{ isset($type) ? '' : 'active' }}" href="{{ route('home') }}">全部分類</a>
                @foreach($post_types as $post_type)
                    <a class="list-group-item {{ isset($type) && $type->id === $post_type->id ? 'active' : '' }}"
                        href="{{ route('home', ['type' => $post_type->id]) }}">{{ $post_type->name }}</a>
                @endforeach
                @if(Auth::check() && Auth::user()->isAdmin())
                    <a class="list-group-item" href="{{ route('type.create') }}">新增分類</a>
                @endif
            </div>
        </div>

    </div>
    <div>
        @if(isset($keyword))
            {{ $posts->appends(['keyword' => $keyword])->render() }}
        @else
            {{ $posts->render() }}
        @endif
    </div>
</div>
<pre>{{ $sql }}</pre>
<pre>{{ var_dump(DB::getQueryLog()) }}</pre>
@endsection
