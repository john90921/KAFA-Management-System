@extends('layouts.master')

@section('content')

    <div class="container mt-3 mb-3">

    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>

                    <div class="row mb-3">
                        <label for="class_name" class="col-md-4 col-form-label text-md-end">{{ __('Class Name') }}</label>

                        <div class="col-md-6">
                            <input id="class_name" type="text" class="form-control" name="class_name" value="{{ $class->class_name }}" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="class_description" class="col-md-4 col-form-label text-md-end">{{ __('Class Description') }}</label>
                    
                        <div class="col-md-6">
                            <input id="class_description" type="text" class="form-control" name="class_description" value="{{ $class->class_description }}" disabled>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="class_teacher" class="col-md-4 col-form-label text-md-end">{{ __('Class Teacher') }}</label>

                        <div class="col-md-6">
                            <input id="class_teacher" type="text" class="form-control" name="class_teacher" value="{!! optional($class->teacher)->user_name ?? 'Not Set Up' !!}" disabled>
                        </div>
                    </div>
                    <br>
                    <div>

                    @if ($students->isNotEmpty())
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student IC</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student Gender</th>
                                <th scope="col">Student Age</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $num = 1
                            @endphp
                            @foreach ($students as $student)
                                <tr>
                                    <th scope="row">{{ $num }}</th>
                                    <td>{{ $student->student_ic }}</td>
                                    <td>{{ $student->student_name }}</td>
                                    <td>{{ $student->student_gender }}</td>
                                    <td>{{ $student->student_age }}</td>
                                </tr>
                                @php
                                    $num++
                                @endphp
                            @endforeach

                            </tbody>
                        </table> 
                    @else
                        <p class="h4 fw-bold d-flex justify-content-center">No Student Added To The Class.</p>
                    @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection