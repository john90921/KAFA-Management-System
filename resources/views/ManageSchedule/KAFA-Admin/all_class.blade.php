@extends('layouts.master')

@section('content')

    <div class="container mt-3 mb-3">

    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif

        <div>
            <div>
    
            @if ($classes->isNotEmpty())
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Class Name</th>
                        <th scope="col">Class Teacher</th>
                        <th scope="col">Class Description</th>
                        <th scope="col">Manage</th>
                    </tr>
                    </thead>
                    <tbody>
    
                    @php
                        $num = 1
                    @endphp
                    @foreach ($classes as $class)
                        <tr>
                            <th scope="row">{{ $num }}</th>
                            <td>{{ $class->class_name }}</td>
                            <td>{!! optional($class->teacher)->user_name ?? '<i>Not Set Up</i>' !!}</td>
                            <td>{{ $class->class_description }}</td>
                            <td>
                                <a href="{{ route('viewclassroom', ['id' => $class->id]) }}" class="btn btn-sm btn-info fw-bold text-white">View</a>
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
                    <p class="h4 fw-bold">No Class Created Yet</p>
                </div>
            @endif
    
            </div>
            <br>
            <div class="d-flex justify-content-end me-4">
                <a href="/add_classroom" class="btn btn-primary fw-bold">Add Class</a>
            </div>
        </div>
    </div>

@endsection