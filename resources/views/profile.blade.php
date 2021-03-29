@extends('layouts.layout')

@section('content')
    <div id="content" class="ms-3">
        <h2 style="margin-left: 12px; margin-bottom: 20px">{{ $author->name }}'s articles</h2>
        @forelse($articles as $article)
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
        @empty
            <h2>No articles yet.</h2>
        @endforelse
        {{ $articles->links() }}
    </div>
@endsection

@section('menu')
    @auth
        <div id="sidebar" class="me-3">
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
