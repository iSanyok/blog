@extends('layouts.layout')

@section('content')
    <h2 style="margin-left: 12px; margin-bottom: 20px">{{ $author->name }}'s articles</h2>
    @forelse($author->articles as $article)
    <div class="container" style="width: 1000px; margin-right: 30%">
        <div style="border-bottom: 1px solid black; margin-bottom: 15px">
            <div class="title">
                <a href="{{ route('show', ['id' => $article->id]) }}" style="text-decoration: none">
                    <h2>{{ $article->title }}</h2>
                </a>
                <span class="byline" style="word-break: break-all">{{ $article->description }}</span> </div>
            <p style="margin-top: -30px; max-width: 500px">
                <img src="{{ asset("banners") . "/" . $article->banner }}" alt="" class="img-fluid"/>
            </p>
            <p style="word-break: break-all; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: -1px; margin-top: -20px">{{ $article->body }}</p>
            <small>{{ $article->updated_at->format('d.m.Y') }}</small>
        </div>
    </div>
    @empty
        <h2>No articles yet.</h2>
    @endforelse
@endsection

@section('menu')
    @auth
<div style="margin-top: 1rem" id="sidebar">
    @if(Auth::user()->id != $author->id)
        @can('subscribe', $author)
            <div style="margin-bottom: 1rem">
                <form action="{{ route('unsubscribe', ['id' => $author->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-dark">unsubscribe</button>
                </form>
            </div>
        @else
            <div style="margin-bottom: 1rem">
                <form action="{{ route('subscribe', ['id' => $author->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark">subscribe</button>
                </form>
            </div>
        @endcan
    @endif
    <div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" form="logout-form" class="btn btn-dark">logout</button>
        </form>
    </div>
        @can('view-subscriptions', $author)
            <h2 style="margin-top: 1rem">subscribes</h2>
            @foreach($author->authors as $a)
                <a href="{{ route('profile', ['id' => $a->authors->id]) }}" style="color: black">
                    <h1>{{ $a->authors->name }}</h1></a>
            @endforeach
        @endcan
</div>
    @endauth
@endsection
