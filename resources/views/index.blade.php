@extends('layouts.layout')

@section('content')
    <div id="content">
    @foreach($articles as $article)
        <div style="border-bottom: 1px solid black">
        <div class="title">
            <a href="{{ route('show', ['id' => $article->id]) }}" style="text-decoration: none"><h2>{{ $article->title }}</h2></a>
            <span class="byline" style="word-break: break-all">{{ $article->description }}</span> </div>
        <p style="margin-top: -30px; max-width: 500px">
            <img src="{{ asset("banners") . "/" . $article->banner }}"
                 alt="" class="image image-full" style="max-height: 650px"/></p>
        <p style="word-break: break-all; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: -1px; margin-top: -20px">{{ $article->body }}</p>
            <small>{{ $article->updated_at->format('d.m.Y') }}</small>
        </div>
        @endforeach
        {{ $articles->links() }}
    </div>

    <div id="sidebar">
        <ul class="style1">
            <h2>most popular</h2>
            <li>
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
    </div>
@endsection
