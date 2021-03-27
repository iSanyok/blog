@extends('layouts.layout')

@section('content')
    <div id="content">
    @foreach($articles as $article)
            <div class="row g-0 bg-light position-relative mb-3">
                <div class="col-md-6 mb-md-0 p-md-4">
                    <img src="{{ asset("banners") . "/" . $article->banner }}" class="w-100" alt="...">
                </div>
                <div class="col-md-6 p-4 ps-md-0" style="position: relative">
                    <h5 class="mt-0">{{ $article->title }}</h5>
                    <p>{{ $article->description }}</p>
                        <a href="{{ route('show', ['id' => $article->id]) }}" class="stretched-link" style="text-decoration: none; color: dimgray">
                            <div class="d-flex flex-nowrap bd-highlight align-self-end " style="position: absolute; bottom: 0; left: 10em">
                                <div class="order-1 p-2 bd-highlight">{{ $article->updated_at->format('d.m.Y') }}</div>
                                <div class="order-3 p-2 bd-highlight">Likes: {{ count($article->likes) }}</div>
                            </div>
                        </a>
                </div>
            </div>

        @endforeach
        {{ $articles->links() }}
    </div>

    <div id="sidebar">
        <ul class="style1">
            <h2 style="border-bottom: solid black 1px">most popular</h2>
            @foreach($popular as $article)
                <div style="border-bottom: 1px solid black">
                    <div class="title">
                        <a href="{{ route('show', ['id' => $article->id]) }}" style="text-decoration: none"><h2>{{ $article->title }}</h2></a>
                        <p>{{ $article->description }}</p>
                    </div>
                    <p style="margin-top: -30px; max-width: 500px">
                    <small>{{ $article->updated_at->format('d.m.Y') }}</small>
                    <small style="margin-left: 60%">Likes: {{ $article->likes }} </small>
                </div>
            @endforeach
        </ul>
    </div>
@endsection
