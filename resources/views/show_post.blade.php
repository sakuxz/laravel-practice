@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="page-header">
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
                <h1>{{ $post->title }}</h1>
                <span class="pull-right">{{ $post->created_at }}</span>
                <span>{{ $post->auther->name }}</span>
                @if($post->postType)
                    <span class="badge">{{ $post->postType->name }}</span>
                @endif
            </div>

            <div>
                {{ $post->content }}
            </div>
        </div>
    </div>
    
</div>
@endsection

