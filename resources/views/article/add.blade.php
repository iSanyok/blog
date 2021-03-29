@extends('layouts.layout')

@section('content')
    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
        @method('POST')
        @csrf

        <div style="padding-bottom: 5px">
            <div><label style="font-size: 20px">
                    Title
                </label></div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input" name="title"
                        value="{{ old('title') }}" aria-describedby="inputGroup-sizing-default">
                </div>
        </div>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div style="padding-bottom: 5px; padding-top: 5px">
            <div><label style="font-size: 20px">
                    Description
                </label></div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" aria-label="Sizing example input" name="description"
                       value="{{ old('description') }}" aria-describedby="inputGroup-sizing-default">
            </div>
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div style="padding-bottom: 5px; padding-top: 5px">
            <div><label style="font-size: 20px">
                    Body
                </label></div>
            <div class="form-floating">
                <textarea class="form-control" name="body"
                          id="floatingTextarea2" style="height: 15em"> {{ old('body') }}</textarea>
            </div>
        </div>
        @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3" style="padding-bottom: 5px; padding-top: 5px; width: 700px">
            <label for="formFile" class="form-label">Select banner</label>
            <input class="form-control" type="file" id="formFile" name="banner">
        </div>

        <button type="submit" class="btn btn-dark">Write</button>
    </form>
@endsection
