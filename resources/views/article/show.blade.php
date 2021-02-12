@extends('layouts.layout')

@section('content')
<div id="content">
    <div class="title">
        <h2>{{ $article->title }}</h2>
        <span class="byline" style="word-break: break-all">{{ $article->description }}</span>
    </div>
    <p><img src="images/banner.jpg" alt="" class="image image-full" /> </p>
    <p style="word-break: break-all">{{ $article->body }}</p>
</div>
@endsection
