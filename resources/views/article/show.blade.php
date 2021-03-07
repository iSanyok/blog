@extends('layouts.layout')

@section('content')
<div id="content">
    <div class="title">
        <h2>{{ $article->title }}</h2>
        <span class="byline" style="word-break: break-all">{{ $article->description }}</span>
    </div>
    <p><img src="{{ asset("banners") . "/" . $article->banner }}" alt="" class="img-fluid" /> </p>
    <p style="word-break: break-all; padding-bottom: 2em">{{ $article->body }}</p>
    <label style="padding-bottom: 1em">Author: <a href="{{ route('profile', ['id' => $article->author->id]) }}"
                                                  style="color: black"> {{ $article->author->name }}</a></label>

    @can('update-article', $article)
        <div>
            <form method="POST" action="{{ route('destroy', ['id' => $article->id]) }}" style="float: left; margin-right: 20px">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-dark">Delete article</button>
            </form>
            @endcan

            @can('delete-article', $article)
            <a href="{{ route('edit', ['id' => $article->id]) }}">
                <button type="submit" class="btn btn-dark">Edit article</button>
            </a>
        </div>
    @endcan
    <div>
        <div>
{{--            <h2>Rating: {{ $rating }}</h2>--}}
            <div>
                <form method="POST" action="{{ route('dislike', ['id' => $article->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">-</button>
                </form>
                <form method="POST" action="{{ route('like', ['id' => $article->id]) }}">
                    @csrf
                    <button type="submit">+</button>
                </form>
            </div>
            <h2 style="margin-bottom: 1em">Comments</h2>
        </div>
        @forelse($comments as $comment)
        <div style="margin-bottom: 1em">
            <div style="border: 1px solid black">
                <a href="{{ route('profile', ['id' => $comment->user->id]) }}" style="text-decoration: none">
                    <h2 style="font-size: 15px; border-bottom: 1px solid black; width: 699px">{{ $comment->user->name }}: </h2></a>
                <p style="word-break: break-all">{{ $comment->content }}</p>
            </div>
        </div>
        @empty
            <h2>No comments yet.</h2>
        @endforelse
        <form method="POST" action="{{ route('storeComment', ['id' => $article->id]) }}">
            @csrf
            <textarea style="width: 700px;" rows="4" name="content"></textarea>
            @auth
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-dark" style="margin-top: 15px">comment</button>
            @else
                <h2 style="font-family: 'Cantarell Extra Bold'">Only authorized users can leave comments</h2>
            @endauth
        </form>
    </div>
</div>
@endsection
