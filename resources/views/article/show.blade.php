@extends('layouts.layout')

@section('content')
<div id="content">
    <div class="title">
        <h2>{{ $article->title }}</h2>
        <span class="byline" style="word-break: break-all">{{ $article->description }}</span>
    </div>
    <p><img src="images/banner.jpg" alt="" class="image image-full" /> </p>
    <p style="word-break: break-all; padding-bottom: 2em">{{ $article->body }}</p>
    <label style="padding-bottom: 1em">Author: <a href="{{ route('home', ['id' => $article->author->id]) }}" style="color: black"> {{ $article->author->name }}</a></label>

    <div>
        <h3 style="margin-bottom: 1em">Comments</h3>
        @forelse($comments as $comment)
        <div style="margin-bottom: 1em">
            <div style="border: 1px solid black">
                <label style="font-size: 15px; border-bottom: 1px solid black; width: 699px">{{ $comment->user->name }}: </label>
                <p style="word-break: break-all">{{ $comment->content }}</p>
            </div>
        </div>
        @empty
            <h2>No comments yet.</h2>
        @endforelse
        <form method="POST" action="">
            <textarea style="width: 700px;" rows="4"></textarea>
            <button type="submit" class="btn btn-dark" style="margin-top: 15px">comment</button>
        </form>
    </div>
</div>
@endsection
