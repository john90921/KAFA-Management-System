@extends('layouts.master')

@section('content')

<div>
    @if(session('message'))
    <div class="alert alert-info" id="success-message">
        {{ session('message') }}
    </div>
    @endif

    <br>
    <div class="container mt-3">
        <div class="row d-flex align-items-center justify-content-between">
            <div class="col-auto">
                <h2 class="mb-0" style="margin-left: 20px;"><b>FEEDBACK</b></h2>
            </div>
        </div>
    </div>


    <br><br>

    <div class="container">
        <div class="row align-items-start">
            <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 60px; background-color: #f2f2f2;">
                <b>Title</b>
            </div>
           
            <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 60px; background-color: #f2f2f2;">
                <b>Description</b>
            </div>

            <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 60px; background-color: #f2f2f2;">
                <b>Apply Date</b>
            </div>

            @if (auth()->user()->role_id == 1)
                <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 60px; background-color: #f2f2f2;">
                    <b>Action</b>
                </div>
            @endif
        </div>
        <br><br>

        @foreach($feedbacks as $feedback)
        <div class="row mb-3">
            <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 60px; background-color: #f2f2f2;">
                {{ $feedback->feedback_title }}
            </div>
           
            <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 60px; background-color: #f2f2f2;">
                {{ $feedback->feedback_description }}
            </div>

            <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 60px; background-color: #f2f2f2;">
                {{ \Carbon\Carbon::parse($feedback->created_at)->format('j F Y') }}
            </div>
            @if (auth()->user()->role_id == 1)
            <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 60px; background-color: #f2f2f2;">
                <form action="{{ route('deleteFeedback', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button> 
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
