<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@extends('layouts.master')

@section('content')
<div class="container mt-3 mb-3">
    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif
    <div class="text-center" style="margin-bottom:2%">
        <h2 class="text-2xl">Assessment List</h2>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" id="error-message">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>

    <div class="box">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Session</th>
                    <th>Assessment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $num = 1;
                @endphp
                @foreach ($assessments as $assessment)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>{{ $assessment->school_session }}</td>
                                    <td>{{ $assessment->exam_type }}</td>
                                    <td>
                                        @if($assessment->results->isNotEmpty())
                                            {{ $assessment->results->first()->result_status }}
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('displayResult', ['assessid' => $assessment->id]) }}"
                                            class="btn btn-primary">Add</a>
                                        <a href="{{ route('updateResult', ['assessid' => $assessment->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                    </td>
                                </tr>

                                @php
                                    $num++;
                                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection