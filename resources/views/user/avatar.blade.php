@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">更換頭貼</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('user.avatar') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label class="col-md-4 control-label">目前頭像</label>

                          <div class="col-md-6">
                              @if (Auth::user()->avatar)
                                  <img style="width: 80px;" src="{{ asset(Auth::user()->avatar) }}" alt="avatar">
                              @else
                                  <img style="width: 80px;" src="https://is5-ssl.mzstatic.com/image/thumb/Purple71/v4/40/8c/4a/408c4a16-8566-d99a-7171-38d69756e71e/iMessage_App_Icon-1x_U007emarketing-0-0-GLES2_U002c0-512MB-sRGB-0-0-0-85-181-0-0-0-0.png/266x200bb.jpeg" alt="avatar">
                              @endif
                          </div>
                        </div>

                        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                            <label for="avatar" class="col-md-4 control-label">上傳新頭像</label>
                            <div class="col-md-6">
                                <input id="avatar" type="file" name="avatar" accept="image/*">
                                <p class="help-block">
                                  jpeg, png, bmp, gif, svg
                                </p>

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">更新頭像</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
