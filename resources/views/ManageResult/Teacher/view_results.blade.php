@extends('layouts.master')

@section('content')
<div class="container mt-3 mb-3">
    @if(session('message'))
        <div class="alert alert-success" id="success-message">
            {{ session('message') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif

    <div class="text-center mb-4">
        <h2 class="text-2xl"><b>View Results</b></h2>
        <p class="text-muted">
            Examination: <strong>{{ $assessment->exam_type }}</strong> | 
            Session: <strong>{{ $assessment->school_session }}</strong>
        </p>
    </div>

    <!-- Subject Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="get" action="{{ route('viewResults', ['assessid' => $assessment->id]) }}">
                <div class="form-group row align-items-center">
                    <label for="subject_name" class="col-md-2 col-form-label text-md-right">Filter by Subject:</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <select id="subject_name" class="form-control" name="subject_name">
                                <option value="">All Subjects</option>
                                @foreach ($subjects as $subs)
                                    <option value="{{$subs->subject_name}}" {{ $subject == $subs->subject_name ? 'selected' : '' }}>
                                        {{$subs->subject_name}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('assessmentdetails') }}" class="btn btn-secondary">Back to Assessment List</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if($allResults->isNotEmpty())
        <!-- Results Table -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-list"></i> Results 
                    @if($subject)
                        - {{ $subject }}
                    @endif
                    ({{ $allResults->count() }} record(s))
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student IC</th>
                                @if(!$subject)
                                    <th scope="col">Subject</th>
                                @endif
                                <th scope="col">Marks</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Feedback</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentSubject = null;
                                $rowNumber = 1;
                            @endphp
                            @foreach ($allResults as $result)
                                @if(!$subject && $result->subject && $result->subject->subject_name != $currentSubject)
                                    @php
                                        $currentSubject = $result->subject->subject_name;
                                    @endphp
                                    <tr class="table-secondary">
                                        <td colspan="{{ $subject ? '7' : '8' }}" class="text-left font-weight-bold">
                                            <i class="fas fa-book"></i> {{ $currentSubject }}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{ $rowNumber++ }}</td>
                                    <td>{{ $result->studentresult->student_name ?? 'N/A' }}</td>
                                    <td>{{ $result->studentresult->student_ic ?? 'N/A' }}</td>
                                    @if(!$subject)
                                        <td>{{ $result->subject->subject_name ?? 'N/A' }}</td>
                                    @endif
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
                                    <td>
                                        <span class="badge text-white
                                            @if($result->result_status == 'Approved') bg-success
                                            @elseif($result->result_status == 'Rejected') bg-danger
                                            @else bg-warning text-dark
                                            @endif" style="font-size: 1em; padding: 0.5em 0.75em;">
                                            {{ $result->result_status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary Statistics -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title"><strong>Summary Statistics</strong></h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Total Students:</strong> {{ $allResults->count() }}
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Average Marks:</strong> 
                                        {{ number_format($allResults->avg('result_marks'), 2) }}
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Highest Mark:</strong> {{ $allResults->max('result_marks') }}
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Lowest Mark:</strong> {{ $allResults->min('result_marks') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <h5><i class="fas fa-exclamation-triangle"></i> No Results Found</h5>
            <p>No results have been entered for this examination yet.</p>
            <a href="{{ route('displayResult', ['assessid' => $assessment->id]) }}" class="btn btn-primary">
                Add Results
            </a>
        </div>
    @endif
</div>
@endsection
