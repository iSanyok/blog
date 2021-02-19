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

@section('logout')
    @auth
<div style="margin-left: 96%; margin-top: 10px">
    <a href="{{ route('logout') }}"><button type="submit" form="logout-form" class="btn btn-dark">logout</button></a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>
    @endauth
@endsection
