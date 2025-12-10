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
                    <form method="POST" action="{{ route('addclassroom.create') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="class_name" class="col-md-4 col-form-label text-md-end">{{ __('Class Name') }}</label>

                            <div class="col-md-6">
                                <input id="class_name" type="text" class="form-control @error('class_name') is-invalid @enderror" name="class_name" value="{{ old('class_name') }}" required autocomplete="class_name" autofocus>

                                @error('class_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="class_description" class="col-md-4 col-form-label text-md-end">{{ __('Class Description') }}</label>
                        
                            <div class="col-md-6">
                                <textarea id="class_description" class="form-control @error('class_description') is-invalid @enderror" name="class_description" required autocomplete="class_description" autofocus>{{ old('class_description') }}</textarea>
                        
                                @error('class_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="class_teacher" class="col-md-4 col-form-label text-md-end">{{ __('Class Teacher') }}</label>

                            <div class="col-md-6">
                                <select id="class_teacher" name="class_teacher" class="form-select" aria-label="Default select example">
                                    <option selected value="null">Select</option>

                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->user_name }}</option>
                                @endforeach
                                
                                </select>

                                @error('class_teacher')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Student IC</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Student Gender</th>
                                    <th scope="col">Student Age</th>
                                    <th scope="col">Add</th>
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
                                        <td>
                                            <input type="checkbox" class="form-check-input add-std-checkbox" name="add_std[]" value="{{ $student->id }}">
                                        </td>
                                    </tr>
                                    @php
                                        $num++;
                                    @endphp
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn text-white fw-bold btn-primary" id="submitButton">
                                    {{ __('Add') }}
                                </button>

                            @foreach (range(1, 5) as $index)
                                &nbsp;
                            @endforeach

                                <button type="reset" class="btn text-white fw-bold btn-danger">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection