@extends('layouts.layout')

@section('content')
    <div id="content" class="mx-30">
        <div class="title">
            <h2>{{ $article->title }}</h2>
            <span class="byline" style="word-break: break-all">{{ $article->description }}</span>
        </div>
        <div>
            <p><img src="{{ asset("banners") . "/" . $article->banner }}" alt="" class="img-fluid"/></p>
        </div>
        <div>
            <p style="word-break: break-all">{{ $article->body }}</p>
        </div>
        @can('update-article', $article)
            <div>
                <form method="POST" action="{{ route('destroy', ['id' => $article->id]) }}"
                      style="float: left; margin-right: 20px">
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
    </div>
    <div id="content" class="mt-5 mx-30 bg-gray d-flex" style="border-radius: 5px">
        <div class="ms-2">
            <label>Author: <a href="{{ route('profile', ['id' => $article->author->id]) }}"
                              style="color: black"> {{ $article->author->name }}</a></label>
        </div>
        <div class="ms-29">
            <button id="like-btn" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chevron-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8
                     5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                </svg>
            </button>
            <label id="likes">{{ $article->rating }}</label>
            <button id="dislike-btn" class="btn" form="dislike-form">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1
                     .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
    </div>
    <div id="content" class="mt-5 mx-30" style="border-radius: 5px">
        @auth()
            <div class="form-floating">
                <textarea name="content" form="comment-form" class="form-control"
                          placeholder="Leave a comment here" style="height: 150px"></textarea>
            </div>
            <input form="comment-form" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button id="comment-btn" form="comment-form" type="submit" class="btn btn-dark mt-3 mb-3">comment</button>
        @else
            <h2 style="font-family: 'Cantarell Extra Bold'">Only authorized users can leave comments</h2>
        @endauth
            <div id="comments">
                @forelse($comments as $comment)
                    <div class="card mt-2">
                        <div class="card-header d-flex">
                            <a href="{{ route('profile', ['id' => $comment->user->id]) }}" style="text-decoration: none">
                                <h5 style="color: black">{{ $comment->user->name }}</h5></a>
                            <small class="ms-34">{{ $comment->created_at->format("d.m.Y") }}</small>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="word-break: break-all">{{ $comment->content }}</p>
                        </div>
                    </div>
                @empty
                    <h2>No comments yet.</h2>
                @endforelse
            </div>
    </div>
    <form id="like-form" method="POST" action="{{ route('like', ['id' => $article->id]) }}">
        @csrf
        @method('PUT')
    </form>
    <form id="dislike-form" method="POST" action="{{ route('dislike', ['id' => $article->id]) }}">
        @csrf
        @method('PUT')
    </form>
    <form id="comment-form" method="POST" action="{{ route('storeComment', ['id' => $article->id]) }}">
        @csrf
    </form>
@endsection
