@extends('layouts.layout')

@section('content')
    <div id="content">

    @foreach($articles as $article)
        <div class="title">
            <a href="{{ route('show', ['id' => $article->id]) }}" style="text-decoration: none"><h2>{{ $article->title }}</h2></a>
            <span class="byline" style="word-break: break-all">{{ $article->description }}</span> </div>
        <p><img src="images/banner.jpg" alt="" class="image image-full" /> </p>
        <p style="word-break: break-all; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: -3px">{{ $article->body }}</p>
            <small>{{ $article->updated_at->format('d.m.Y') }}</small>
        @endforeach
    </div>

    <div id="sidebar">
        <ul class="style1">
            <li class="first">
                <h3>Amet sed volutpat mauris</h3>
                <p><a href="#">In posuere eleifend odio. Quisque semper augue mattis wisi. Pellentesque viverra vulputate enim. Aliquam erat volutpat.</a></p>
            </li>
            <li>
                <h3>Sagittis diam dolor sit amet</h3>
                <p><a href="#">In posuere eleifend odio. Quisque semper augue mattis wisi. Pellentesque viverra vulputate enim. Aliquam erat volutpat.</a></p>
            </li>
            <li>
                <h3>Maecenas ac quam risus</h3>
                <p><a href="#">In posuere eleifend odio. Quisque semper augue mattis wisi. Pellentesque viverra vulputate enim. Aliquam erat volutpat.</a></p>
            </li>
        </ul>
        <div id="stwo-col">
            <div class="sbox1">
                <h2>Etiam rhoncus</h2>
                <ul class="style2">
                    <li><a href="#">Semper quis egetmi dolore</a></li>
                    <li><a href="#">Quam turpis feugiat dolor</a></li>
                    <li><a href="#">Amet ornare hendrerit lectus</a></li>
                    <li><a href="#">Quam turpis feugiat dolor</a></li>
                </ul>
            </div>
            <div class="sbox2">
                <h2>Integer gravida</h2>
                <ul class="style2">
                    <li><a href="#">Semper quis egetmi dolore</a></li>
                    <li><a href="#">Quam turpis feugiat dolor</a></li>
                    <li><a href="#">Consequat lorem phasellus</a></li>
                    <li><a href="#">Amet turpis feugiat amet</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
