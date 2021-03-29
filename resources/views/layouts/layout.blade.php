<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name') }}</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet"/>
    <link href="/css/default.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/fonts.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
<div id="header-wrapper" class="d-flex justify-content-end py-1">
    <ul class="nav nav-pills">
        <li class="nav-item me-95">
            <a class="nav-link" aria-current="page" href="{{ route('index') }}">BLOZHEK</a>
        </li>
        @auth
            <li class="nav-item dropdown me-5">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button"
                   aria-expanded="false">{{ Auth::user()->name }}</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile', ['id' => Auth::user()->id]) }}">My
                            Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('add') }}">Write Article</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" role="button">
                            <button type="submit" form="logout-form" class="logout-button justify-content-start">logout</button>
                        </a>
                    </li>
                </ul>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        @else
            <li class="nav-item me-3">
                <a class="nav-link" href="{{ route('login') }}">Sign in</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link" href="{{ route('register') }}">Sign up</a>
            </li>
        @endauth

    </ul>
    {{--    <div id="header" class="container">--}}
    {{--        <div id="logo">--}}
    {{--            <h1><a href="{{ route('index') }}">{{ config('app.name') }}</a></h1>--}}
    {{--        </div>--}}
    {{--        <div id="menu">--}}
    {{--            <ul>--}}
    {{--                <li class="{{Request::path() === '/' ? 'current_page_item' : ''}}">--}}
    {{--                    <a href="{{ route('index') }}" accesskey="1" title="">Homepage</a></li>--}}
    {{--                <li class="{{Request::path() === 'add' ? 'current_page_item' : ''}}">--}}
    {{--                    <a href="{{ route('add') }}" accesskey="2" title="">Write article</a></li>--}}
    {{--                @if (Route::has('login'))--}}
    {{--                    @auth--}}
    {{--                        <li>--}}
    {{--                            <div class="dropdown">--}}
    {{--                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
    {{--                                    Dropdown button--}}
    {{--                                </button>--}}
    {{--                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
    {{--                                    <li><a class="dropdown-item" href="#">Action</a></li>--}}
    {{--                                    <li><a class="dropdown-item" href="#">Another action</a></li>--}}
    {{--                                    <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}
    {{--                            <a href="{{ route('profile', ['id' => Auth::user()->id]) }}" accesskey="3">{{ Auth::user()->name }}</a>--}}
    {{--                        </li>--}}

    {{--                    @else--}}
    {{--                        <li class="{{Request::path() === 'login' ? 'current_page_item' : ''}}">--}}
    {{--                            <a href="{{ route('login') }}" accesskey="4" title="">Sign in</a></li>--}}

    {{--                        @if (Route::has('register'))--}}
    {{--                            <li class="{{Request::path() === 'register' ? 'current_page_item' : ''}}">--}}
    {{--                                <a href="{{ route('register') }}" accesskey="5" title="">Sign up</a></li>--}}
    {{--                        @endif--}}
    {{--                    @endauth--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--            </ul>--}}
    {{--        </div>--}}
</div>
</div>

@yield('menu')

<div id="wrapper">
    <div id="page" class="container">
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
