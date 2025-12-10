<!-- resources/views/result_slip.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="margin-bottom: 20px;"></div>
                <h3 class="text-center"><b>RESULT SLIP</b></h3><br>

                <div class="card-body">
                    <div class="result-info">
                        <p><strong>Name:</strong> {{ $student->student_name }}</p>
                        <p><strong>IC No:</strong> {{ $student->student_ic }}</p>
                        <p><strong>Class:</strong> {{ $student->classroom->class_name }}</p>
                        <p><strong>Gender:</strong> {{ $student->student_gender }}</p>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Subjects</th>
                                <th>Mark</th>
                                <th>Grade</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($results as $result)
                                    <tr>
                                        <td>{{ $num }}</td>
                                        <td>{{ $result->subject->subject_name }}</td>
                                        <td>{{ $result->result_marks }}</td>
                                        <td>{{ $result->result_grades }}</td>
                                        <td>{{ $result->result_feedback }}</td>
                                    </tr>
                                    @php
                                    $num++;
                                    @endphp
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection