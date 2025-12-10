@extends('layouts.master')

@section('content')

    <div class="container mt-3 mb-3">

    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif
        
        @include('ManageSchedule.schedule')
    </div>
    
@endsection