@extends('layouts.master')

@section('content')
<div class="container">
    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
     @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center"><b>STUDENT LIST REVIEW</b></h3>
                </div>
                <div class="card-body">
                    <div class="student-info">
                        <p><strong>Name:</strong> {{ $result->studentresult->student_name }}</p>
                        <p><strong>Subject:</strong> {{ $result->subject->subject_name }}</p>
                        <p><strong>Marks:</strong> {{ $result->result_marks }}</p>
                        <p><strong>Grade:</strong> {{ $result->result_grades }}</p>
                        <p><strong>Feedback:</strong> {{ $result->result_feedback }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('updateapproval', ['result_id' => $result->id]) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('deleteapproval', ['result_id' => $result->id]) }}" method="POST"
                    style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
