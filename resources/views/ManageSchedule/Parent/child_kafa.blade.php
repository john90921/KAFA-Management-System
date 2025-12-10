@extends('layouts.master')

@section('content')

    <div class="container mt-3 mb-3">

    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif

        <div>
            
        @if ($childs->isNotEmpty())
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Identity Card Number</th>
                    <th scope="col">Classroom</th>
                    <th scope="col">Schedule</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $num = 1
                @endphp
                @foreach ($childs as $child)
                    <tr>
                        <th scope="row">{{ $num }}</th>
                        <td>{{ $child->student_name }}</td>
                        <td>{{ $child->student_ic }}</td>
                        <td class="text-capitalize">{{ optional($child->classroom)->class_name ?? 'No Class Yet' }}</td>
                        <td>
                        @if (is_null($child->classroom_id))
                            <i>Not Available</i>
                        @else
                            <a href="{{ route('kafaschedule', ['id' => $child->classroom_id]) }}" class="btn btn-sm btn-info fw-bold text-white">View</a>
                        @endif
                        </td>
                    </tr>
                    @php
                        $num++
                    @endphp
                @endforeach
                
                </tbody>
            </table>
        @else
            <div class="d-flex justify-content-center">
                <p class="h3 fw-bold">You Not Register Children Yet</p>
            </div>
        @endif
        
        </div>
    </div>

@endsection