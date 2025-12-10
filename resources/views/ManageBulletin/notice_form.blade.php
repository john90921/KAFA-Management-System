@extends('layouts.master')

@section('content')
<div class="container">
    <br>
    <h3><b>NOTICE</b></h3><br>

    <form method="POST" action="{{ route('createnotice') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 row">
            <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputTitle" name="notice_title">
            </div>
        </div>

        <br>

        <div class="mb-3 row">
            <label for="inputText" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="inputText" name="notice_text" rows="4" width="100px"></textarea>
            </div>
        </div>

        <br>

        <div class="mb-3 row">
            <label for="inputPoster" class="col-sm-2 col-form-label">Poster</label>
            <div class="col-sm-10">
                <input class="form-control" name="notice_poster" type="file" id="inputPoster"></>
            </div>
        </div>

        <br><br><br>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>

                @foreach (range(1, 3) as $index)
                &nbsp;
                @endforeach

                <a href="{{route('allnotices')}}" class="btn btn-secondary">
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>
    </form>
</div>
@endsection