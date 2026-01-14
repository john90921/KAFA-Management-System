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

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center mb-0"><b><i class="fas fa-clipboard-check"></i> STUDENT RESULTS REVIEW</b></h3>
                </div>

                <div class="card-body">
                    @if(isset($allResults) && $allResults->isNotEmpty())
                        @php
                            $firstResult = $allResults->first();
                            $examination = $firstResult->examination;
                            $subject = $firstResult->subject;
                            $classroom = $firstResult->studentresult->classroom ?? null;
                        @endphp

                        <!-- Examination Information -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <strong><i class="fas fa-calendar"></i> Session:</strong> {{ $examination->school_session }}
                                            </div>
                                            <div class="col-md-3">
                                                <strong><i class="fas fa-book"></i> Assessment:</strong> {{ $examination->exam_type }}
                                            </div>
                                            <div class="col-md-3">
                                                <strong><i class="fas fa-book-open"></i> Subject:</strong> {{ $subject->subject_name }}
                                            </div>
                                            <div class="col-md-3">
                                                <strong><i class="fas fa-users"></i> Class:</strong> {{ $classroom->class_name ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bulk Approval Option -->
                        @php
                            $pendingCount = $allResults->where('result_status', 'Pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                        <div class="alert alert-info mb-3">
                            <form action="{{ route('bulkApprove') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="result_id" value="{{ $result->id }}">
                                <strong><i class="fas fa-info-circle"></i> {{ $pendingCount }} result(s) pending approval.</strong>
                                <button type="submit" class="btn btn-success btn-sm ml-3" onclick="return confirm('Are you sure you want to approve ALL pending results for this subject?');">
                                    <i class="fas fa-check-double"></i> Approve All Pending
                                </button>
                            </form>
                        </div>
                        @endif

                        <!-- Results Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Student IC</th>
                                        <th scope="col">Marks</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">Feedback</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allResults as $index => $res)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-left">{{ $res->studentresult->student_name ?? 'N/A' }}</td>
                                            <td>{{ $res->studentresult->student_ic ?? 'N/A' }}</td>
                                            <td><strong class="h5">{{ $res->result_marks }}</strong></td>
                                            <td>
                                                <span class="badge text-white
                                                    @if($res->result_grades == 'A') bg-success
                                                    @elseif($res->result_grades == 'B') bg-info
                                                    @elseif($res->result_grades == 'C') bg-warning text-dark
                                                    @elseif($res->result_grades == 'D') bg-secondary
                                                    @else bg-danger
                                                    @endif" style="font-size: 1em; padding: 0.5em 0.75em;">
                                                    {{ $res->result_grades }}
                                                </span>
                                            </td>
                                            <td class="text-left">{{ $res->result_feedback }}</td>
                                            <td>
                                                <span class="badge text-white
                                                    @if($res->result_status == 'Approved') bg-success
                                                    @elseif($res->result_status == 'Rejected') bg-danger
                                                    @else bg-warning text-dark
                                                    @endif" style="font-size: 1em; padding: 0.5em 0.75em;">
                                                    {{ $res->result_status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($res->result_status == 'Pending')
                                                    <form action="{{ route('updateapproval') }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <input type="hidden" name="result_id" value="{{ $res->id }}">
                                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve this result?');">
                                                            <i class="fas fa-check"></i> Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('deleteapproval') }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <input type="hidden" name="result_id" value="{{ $res->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Reject this result?');">
                                                            <i class="fas fa-times"></i> Reject
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">No action needed</span>
                                                @endif
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
                                        <h6 class="card-title"><strong>Summary</strong></h6>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <strong>Total Students:</strong> {{ $allResults->count() }}
                                            </div>
                                            <div class="col-md-3">
                                                <strong>Approved:</strong> 
                                                <span class="badge bg-success">{{ $allResults->where('result_status', 'Approved')->count() }}</span>
                                            </div>
                                            <div class="col-md-3">
                                                <strong>Pending:</strong> 
                                                <span class="badge bg-warning text-dark">{{ $allResults->where('result_status', 'Pending')->count() }}</span>
                                            </div>
                                            <div class="col-md-3">
                                                <strong>Rejected:</strong> 
                                                <span class="badge bg-danger">{{ $allResults->where('result_status', 'Rejected')->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle"></i> No Results Found</h5>
                            <p>No results found for this selection.</p>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="row mt-4">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('resultapprovallist') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Approval List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
