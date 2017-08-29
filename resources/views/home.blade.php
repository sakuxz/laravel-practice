@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($posts as $post)
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $post->title }}</div>

                    <div class="panel-body">
                        @if (session('test'))
                            <div class="alert alert-success">
                                {{ session('test') }}
                            </div>
                        @endif
                        <p>{{ $post->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
