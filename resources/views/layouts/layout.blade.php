<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link href="/css/default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/fonts.css" rel="stylesheet" type="text/css" media="all" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>
<body>
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="{{ route('index') }}">{{ config('app.name') }}</a></h1>
        </div>
        <div id="menu">
            <ul>
                <li class="{{Request::path() === '/' ? 'current_page_item' : ''}}">
                    <a href="{{ route('index') }}" accesskey="1" title="">Homepage</a></li>
                <li class="{{Request::path() === 'add' ? 'current_page_item' : ''}}">
                    <a href="{{ route('add') }}" accesskey="2" title="">Write article</a></li>
                <li class="{{Request::path() === '' ? 'current_page_item' : ''}}">
                    <a href="#" accesskey="3" title="">test111</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="{{Request::path() === 'home' ? 'current_page_item' : ''}}">
                            <a href="{{ route('profile', ['id' => Auth::user()->id]) }}" accesskey="3">Home</a></li>

                    @else
                        <li class="{{Request::path() === 'login' ? 'current_page_item' : ''}}">
                            <a href="{{ route('login') }}" accesskey="4" title="">Login</a></li>

                        @if (Route::has('register'))
                            <li class="{{Request::path() === 'register' ? 'current_page_item' : ''}}">
                                <a href="{{ route('register') }}" accesskey="5" title="">Register</a></li>
                        @endif
                    @endauth
                    </div>
                @endif
            </ul>
        </div>
    </div>
</div>

@yield('logout')

<div id="wrapper">
    <div id="page" class="container">

        @yield('content')

    </div>
</div>
</body>
</html>
