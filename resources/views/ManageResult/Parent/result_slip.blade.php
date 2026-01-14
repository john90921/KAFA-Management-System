<!-- resources/views/result_slip.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container mt-3 mb-3">
    @if(session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0"><b>RESULT SLIP</b></h3>
                </div>

                <div class="card-body">
                    <!-- Student Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-user"></i> Student Information</h5>
                                    <hr>
                                    <p class="mb-2"><strong>Name:</strong> {{ $student->student_name }}</p>
                                    <p class="mb-2"><strong>IC No:</strong> {{ $student->student_ic }}</p>
                                    <p class="mb-2"><strong>Class:</strong> {{ $student->classroom->class_name ?? 'Not Assigned' }}</p>
                                    <p class="mb-0"><strong>Gender:</strong> {{ $student->student_gender }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-calendar"></i> Examination Information</h5>
                                    <hr>
                                    <p class="mb-2"><strong>Session:</strong> {{ $examination->school_session }}</p>
                                    <p class="mb-2"><strong>Assessment Type:</strong> {{ $examination->exam_type }}</p>
                                    <p class="mb-0"><strong>Date Generated:</strong> {{ now()->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Results Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Marks</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                    $totalMarks = 0;
                                    $subjectCount = 0;
                                @endphp
                                @foreach ($results as $result)
                                    <tr>
                                        <td>{{ $num }}</td>
                                        <td class="text-left"><strong>{{ $result->subject->subject_name }}</strong></td>
                                        <td>
                                            <strong class="h5">{{ $result->result_marks }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge text-white
                                                @if($result->result_grades == 'A') bg-success
                                                @elseif($result->result_grades == 'B') bg-info
                                                @elseif($result->result_grades == 'C') bg-warning text-dark
                                                @elseif($result->result_grades == 'D') bg-secondary
                                                @else bg-danger
                                                @endif" style="font-size: 1em; padding: 0.5em 0.75em;">
                                                {{ $result->result_grades }}
                                            </span>
                                        </td>
                                        <td class="text-left">{{ $result->result_feedback }}</td>
                                    </tr>
                                    @php
                                        $num++;
                                        $totalMarks += $result->result_marks;
                                        $subjectCount++;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td colspan="2" class="text-right"><strong>Total / Average:</strong></td>
                                    <td><strong>{{ $totalMarks }} / {{ $subjectCount > 0 ? number_format($totalMarks / $subjectCount, 2) : 0 }}</strong></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Summary Card -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h6 class="card-title"><strong><i class="fas fa-chart-bar"></i> Performance Summary</strong></h6>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Total Subjects:</strong> {{ $subjectCount }}
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Total Marks:</strong> {{ $totalMarks }}
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Average Marks:</strong> {{ $subjectCount > 0 ? number_format($totalMarks / $subjectCount, 2) : 0 }}
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Highest Mark:</strong> {{ $results->max('result_marks') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('selectresultinfo') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Result Selection
                            </a>
                            <button onclick="window.print()" class="btn btn-primary">
                                <i class="fas fa-print"></i> Print Result Slip
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
    @media print {
        .btn, .card-header, .navbar, .sidebar {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection