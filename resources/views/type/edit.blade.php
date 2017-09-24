@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">編輯分類</div>
                
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('type.update', ['id' => $type->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">分類名稱</label>
                            
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $type->name }}" required autofocus>
                                
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">修改分類</button>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

