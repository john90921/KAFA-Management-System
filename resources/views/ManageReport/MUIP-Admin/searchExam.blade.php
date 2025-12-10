@extends('layouts.master')

@section('content')
    <div>
        <form action="{{route('gradeReport')}}" method="get">
            <input type="hidden" value="{{ $subject->id }}" name="subject">

            <div class="mb-3 error-placeholder">
                <select id="validation-select" class="form-select" style="width: 400px;" name="exam_id">
                    <option value="" diabled selected>Select Examination</option>
                    @foreach ($examinations as $examination)
                        <option value="{{$examination->id}}">{{ $examination->exam_type }} {{ $examination->school_session }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="mb-3 error-placeholder">
                <select class="form-select" style="width: 400px;" name="class">
                    <option value>Class</option>
                    @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="mb-3 d-flex justify-content-left">
                <button type="submit" class="btn btn-primary">
                    {{ __('Search') }}
                </button>
            </div>
        </form>
    </div>
@endsection