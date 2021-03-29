@extends('layouts.layout')

@section('content')
    <div style="width: 44em" class="ms-3">
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
            @method('POST')
            @csrf

            <div>
                <div><label>
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

            <div>
                <div><label>
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

            <div>
                <div><label>
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

            <div class="mt-3">
                <label for="formFile" class="form-label">Select banner</label>
                <input class="form-control" type="file" id="formFile" name="banner">
            </div>

            <button type="submit" class="btn btn-dark mt-2">Write</button>
        </form>
    </div>
@endsection
