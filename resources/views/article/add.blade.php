@extends('layouts.layout')

@section('content')
    @guest
        <script>window.location = '/login';</script>
    @endguest

    <form method="POST" action="{{ route('store') }}">
        @method('POST')
        @csrf

        <div style="padding-bottom: 5px">
            <div><label style="font-size: 20px">
                    Title
                </label></div>
            <input type="text" name="title" style="width: 550px" value="{{ old('title') }}">
        </div>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div style="padding-bottom: 5px; padding-top: 5px">
            <div><label style="font-size: 20px">
                    Description
                </label></div>
            <input type="text" name="description" style="width: 550px" value="{{ old('description') }}">
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div style="padding-bottom: 5px; padding-top: 5px">
            <div><label style="font-size: 20px">
                    Body
                </label></div>
            <textarea name="body" style="width: 700px; font-family: Arial" placeholder="Write something interesting!" rows="10">{{ old('body') }}</textarea>
        </div>
        @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-dark">Write</button>
    </form>
@endsection
