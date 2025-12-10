@extends('layouts.master')

@section('content')
<div class="container">
    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif
    <br>
    <h3 class="text-center"><b>EDIT EVALUATION</b></h3><br>
    <div class="container">
        <form method="get" action="{{ route('updateResult', ['assessid' => $assessment->id]) }}">
            @csrf
            <div class="form-group row align-items-center">
                <label for="subject_name" class="col-md-2 col-form-label text-md-right">Subject</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <select id="subject_name" class="form-control @error('subject_name') is-invalid @enderror"
                            name="subject_name">
                            <option value="" selected disabled>Subject</option>
                            @foreach ($subjects as $subs)
                                <option value="{{$subs->subject_name}}">{{$subs->subject_name}}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append"> &nbsp;
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                    @error('subject_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </form>

        <br><br>

        @if ($students && $students->isNotEmpty())
        <form method="POST" action="{{ route('editResult', ['assessid' => $assessment->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" value="{{ $assessment->id }}" name="assessid">
            <input type="hidden" value="{{ $subsid->id }}" name="subs">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Marks</th>
                            <th scope="col">Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $index => $result)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $result->studentresult->student_name }}</td>
                                <td>
                                    <input type="number" name="result_marks[{{$result->studentresult->id}}]" value="{{ $result->result_marks }}" min="0" max="100" required>
                                </td>
                                <td>
                                    <textarea name="result_feedback[{{$result->studentresult->id}}]" cols="30" rows="2" required>{{ $result->result_feedback }}</textarea>
                                </td>
                                <input type="hidden" name="student_ids[{{ $result->studentresult->id }}]" value="{{ $result->studentresult->id }}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('assessmentdetails', ['assessid' => $assessment->id])}}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>

        @endif

    </div>
    @endsection