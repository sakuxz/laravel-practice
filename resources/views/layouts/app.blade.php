<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav hidden">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        @if (Auth::user()->avatar)
                                            <div style="
                                                float: left;
                                                width: 30px;
                                                height: 30px;
                                                margin-top: -4px;
                                                margin-right: 5px;
                                                border-radius: 50%;
                                                border: 1px solid #9b9b9b;
                                                overflow: hidden;
                                                background-image: url('{{ Auth::user()->avatar }}');
                                                background-size: cover;
                                                background-position: center;
                                            "></div>
                                        @else
                                            <div style="
                                                float: left;
                                                width: 30px;
                                                height: 30px;
                                                margin-top: -4px;
                                                margin-right: 5px;
                                                border-radius: 50%;
                                                border: 1px solid #9b9b9b;
                                                overflow: hidden;
                                                background-image: url('https://is5-ssl.mzstatic.com/image/thumb/Purple71/v4/40/8c/4a/408c4a16-8566-d99a-7171-38d69756e71e/iMessage_App_Icon-1x_U007emarketing-0-0-GLES2_U002c0-512MB-sRGB-0-0-0-85-181-0-0-0-0.png/266x200bb.jpeg');
                                                background-size: cover;
                                                background-position: center;
                                            "></div>
                                        @endif
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
