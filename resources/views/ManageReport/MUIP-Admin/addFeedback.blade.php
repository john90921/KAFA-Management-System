@extends('layouts.master')

@section('content')
<div class="container">
    <br>
    <h3><b>Feedback</b></h3><br>

    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
     @endif

    <form method="POST" action="{{ route('saveFeedback') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3 row">
            <label for="feedback_title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="feedback_title" name="feedback_title">
            </div>
        </div>

        {{-- <br> --}}

        <div class="mb-3 row">
            <label for="feedback_description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="feedback_description" name="feedback_description" rows="4" width="100px"></textarea>
            </div>
        </div>

        {{-- <br> --}}


        {{-- <br><br><br> --}}

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save') }}
                </button>

                @foreach (range(1, 3) as $index)
                &nbsp;
                @endforeach

               
            </div>
        </div>
    </form>
</div>
@endsection