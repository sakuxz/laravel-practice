@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">新文章</div>
                
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('home.create') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">標題</label>
                            
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                                
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">文章分類</label>
                            
                            <div class="col-md-6">
                                <select class="form-control" name="type" id="type">
                                    <option value=""></option>
                                    @foreach($post_types as $post_type)
                                    <option value="{{ $post_type->id }}">{{ $post_type->name }}</option>
                                    @endforeach
                                </select>
                                
                                @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">內容</label>
                            
                            <div class="col-md-6">
                                <textarea id="content" class="form-control" name="content" rows="10" required>{{ old('content') }}</textarea>
                                
                                @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">新增文章</button>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

