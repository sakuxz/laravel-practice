@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
             @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif
            <h6 class="clearfix">
                @if(Auth::check())
                    <div class="pull-right">
                        <a href="{{ route('home.create') }}" class="btn btn-xs btn-default">
                            新增文章
                        </a>
                    </div>
                @endif
                @if(isset($keyword))
                    搜尋：{{ $keyword }}
                @else
                    所有文章
                @endif
            </h6>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                                <form method="POST" action="{{ route('home.destroy', ['post' => $post->id]) }}">
                                    <a class="btn btn-xs btn-primary" href="{{ route('home.edit', ['post' => $post->id]) }}">
                                        編輯
                                    </a>
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button class="btn btn-xs btn-danger" type="submit">
                                        刪除
                                    </button>
                                </form>
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

            @if(isset($keyword))
                {{ $posts->appends(['keyword' => $keyword])->render() }}
            @else
                {{ $posts->render() }}
            @endif
        </div>
    </div>
</div>
<pre>{{ $sql }}</pre>
<pre>{{ var_dump(DB::getQueryLog()) }}</pre>
@endsection
