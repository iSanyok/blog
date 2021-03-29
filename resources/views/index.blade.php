@extends('layouts.layout')

@section('content')
    <div id="content" class="ms-3">
        @foreach($articles as $article)
            <div class="row g-0 bg-light position-relative mb-3">
                <div class="col-md-6 mb-md-0 p-md-4">
                    <img src="{{ asset("banners") . "/" . $article->banner }}" class="w-100" alt="...">
                </div>
                <div class="col-md-6 p-4 ps-md-0" style="position: relative">
                    <h5 class="mt-0">{{ $article->title }}</h5>
                    <p>{{ $article->description }}</p>
                    <a href="{{ route('show', ['id' => $article->id]) }}" class="stretched-link"
                       style="text-decoration: none; color: dimgray">
                        <div class="d-flex flex-nowrap bd-highlight align-self-end "
                             style="position: absolute; bottom: 0; left: 10em">
                            <div class="order-1 p-2 bd-highlight">
                                <small>{{ $article->updated_at->format('d.m.Y') }}</small></div>
                            <div class="order-3 p-2 bd-highlight"><small>Likes: {{ count($article->likes) }}</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
        {{ $articles->links() }}
    </div>

    <div id="sidebar" class="me-3">
        <h1>most popular</h1>
        <ul class="nav nav-tabs" id="nav">
            <li class="nav-item">
                <a class="nav-link active sidebar" href="{{ route('getToday')}}">Today</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar" href="{{ route('getWeek') }}" id="">Week</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar" href="{{ route('getMouth') }}">Mouth</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar" href="{{ route('getYear') }}">Year</a>
            </li>
        </ul>
    </div>
@endsection
