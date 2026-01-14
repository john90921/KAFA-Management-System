@extends('layouts.master')

@section('content')
<div class="container">
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
    <br>
    <h3 class="text-center"><b>ADD EVALUATION</b></h3><br>
    <div class="container">
        <form method="get" action="{{ route('displayResult', ['assessid' => $assessment->id]) }}">
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
        
        <!-- Performance Summary Statistics Card -->
        @if(isset($statistics) && $statistics)
        <div class="card mb-4 border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-chart-line"></i> Class Performance Summary</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Class Average</h6>
                                <h3 class="text-primary mb-0">
                                    <strong>{{ number_format($statistics['class_average'], 2) }}</strong>
                                </h3>
                                <small class="text-muted">out of 100</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Highest Mark</h6>
                                <h3 class="text-success mb-0">
                                    <strong>{{ $statistics['highest_mark'] }}</strong>
                                </h3>
                                <small class="text-muted">out of 100</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Lowest Mark</h6>
                                <h3 class="text-danger mb-0">
                                    <strong>{{ $statistics['lowest_mark'] }}</strong>
                                </h3>
                                <small class="text-muted">out of 100</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Total Students</h6>
                                <h3 class="text-info mb-0">
                                    <strong>{{ $statistics['total_students'] }}</strong>
                                </h3>
                                <small class="text-muted">with results</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mt-3 mb-0">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Performance Insight:</strong> 
                    @if($statistics['class_average'] >= 80)
                        Excellent class performance! The average indicates strong understanding of the subject.
                    @elseif($statistics['class_average'] >= 60)
                        Good class performance. Consider reviewing topics where students scored below average.
                    @elseif($statistics['class_average'] >= 40)
                        Moderate performance. Additional support may be needed for struggling students.
                    @else
                        Low average score. Consider reviewing the assessment difficulty or providing additional support.
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Display Existing Results Section -->
        @if(isset($existingResults) && $existingResults->isNotEmpty())
        <div class="card mb-4 border-success">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-eye"></i> Existing Results</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Below are the results that have already been entered for this subject and examination.</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student IC</th>
                                <th scope="col">Marks</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Feedback</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($existingResults as $index => $result)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $result->studentresult->student_name ?? 'N/A' }}</td>
                                    <td>{{ $result->studentresult->student_ic ?? 'N/A' }}</td>
                                    <td><strong>{{ $result->result_marks }}</strong></td>
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
                                    <td>{{ $result->result_feedback }}</td>
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
                <div class="alert alert-info mt-3">
                    <strong>Note:</strong> To update these results, use the "Edit" button from the Assessment List page, or upload a new CSV file (which will update existing records).
                </div>
            </div>
        </div>
        <hr class="my-4">
        @endif
        <!-- CSV Upload Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-upload"></i> Bulk Upload via CSV</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Upload a CSV file to import results for all students at once. The file should contain Student IC, Marks, and optional Feedback.</p>
                
                <form method="POST" action="{{ route('importResults', $assessment->id) }}" enctype="multipart/form-data" class="mb-3">
                    @csrf
                    <input type="hidden" value="{{ $assessment->id }}" name="assessid">
                    <input type="hidden" value="{{ $subsid->id }}" name="subs">
                    
                    <div class="form-group row">
                        <label for="csv_file" class="col-md-3 col-form-label">Select CSV File:</label>
                        <div class="col-md-6">
                            <input type="file" 
                                   class="form-control @error('csv_file') is-invalid @enderror" 
                                   id="csv_file" 
                                   name="csv_file" 
                                   accept=".csv,.txt"
                                   required>
                            @error('csv_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">
                                File format: CSV with columns: Student IC, Marks, Feedback (optional). Max size: 5MB
                            </small>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload"></i> Upload CSV
                            </button>
                        </div>
                    </div>
                </form>
                
                <div class="alert alert-info">
                    <strong>CSV Format:</strong><br>
                    <code>Student IC, Marks, Feedback</code><br>
                    Example:<br>
                    <code>300000000003, 85, Excellent work</code><br>
                    <code>300000000004, 72, Good progress</code><br>
                    <small>Note: Header row is optional. If included, it will be automatically skipped.</small>
                </div>
                
                <a href="{{ asset('templates/result_import_template.csv') }}" class="btn btn-outline-primary btn-sm" download>
                    <i class="fas fa-download"></i> Download CSV Template
                </a>
            </div>
        </div>

        <hr class="my-4">
        <h5 class="text-center mb-3">OR Enter Results Manually</h5>
        <hr class="my-4">
        
        <!-- Real-Time Performance Statistics (for manual entry) -->
        <div class="card mb-4 border-info" id="realtimeStatsCard" style="display: none;">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Real-Time Performance Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Class Average</h6>
                                <h3 class="text-primary mb-0">
                                    <strong id="realtimeAverage">0.00</strong>
                                </h3>
                                <small class="text-muted">out of 100</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Highest Mark</h6>
                                <h3 class="text-success mb-0">
                                    <strong id="realtimeHighest">-</strong>
                                </h3>
                                <small class="text-muted">out of 100</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Lowest Mark</h6>
                                <h3 class="text-danger mb-0">
                                    <strong id="realtimeLowest">-</strong>
                                </h3>
                                <small class="text-muted">out of 100</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Note:</strong> Statistics update automatically as you enter marks. Only filled marks are included in calculations.
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('addResult', ['assessid' => $assessment->id]) }}" enctype="multipart/form-data" id="resultForm">
        @csrf

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
                    @foreach ($students as $index => $student)
                        @php
                            $existingResult = isset($existingResults) ? $existingResults->get($student->id) : null;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->student_name }}</td>
                            <td>
                                @if($existingResult)
                                    <input type="number" 
                                           name="result_marks[{{$student->id}}]" 
                                           value="{{ $existingResult->result_marks }}" 
                                           min="0" 
                                           max="100" 
                                           required
                                           class="form-control bg-light marks-input"
                                           data-student-id="{{ $student->id }}"
                                           title="Existing mark: {{ $existingResult->result_marks }}">
                                    <small class="text-muted">Current: {{ $existingResult->result_marks }}</small>
                                @else
                                    <input type="number" 
                                           name="result_marks[{{$student->id}}]" 
                                           min="0" 
                                           max="100" 
                                           required
                                           class="form-control marks-input"
                                           data-student-id="{{ $student->id }}">
                                @endif
                            </td>
                            <td>
                                @if($existingResult)
                                    <textarea name="result_feedback[{{$student->id}}]" 
                                              cols="30" 
                                              rows="2" 
                                              required>{{ $existingResult->result_feedback }}</textarea>
                                @else
                                    <textarea name="result_feedback[{{$student->id}}]" 
                                              cols="30" 
                                              rows="2" 
                                              required></textarea>
                                @endif
                            </td>
                            <input type="hidden" name="student_ids[{{ $student->id }}]" value="{{$student->id}}">
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('addResult',['assessid' => $assessment->id])}}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
@endif

    </div>

    <!-- JavaScript for Real-Time Statistics Calculation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const marksInputs = document.querySelectorAll('.marks-input');
            const statsCard = document.getElementById('realtimeStatsCard');
            const averageElement = document.getElementById('realtimeAverage');
            const highestElement = document.getElementById('realtimeHighest');
            const lowestElement = document.getElementById('realtimeLowest');

            function calculateStatistics() {
                const marks = [];
                
                marksInputs.forEach(function(input) {
                    const value = parseFloat(input.value);
                    if (!isNaN(value) && value >= 0 && value <= 100) {
                        marks.push(value);
                    }
                });

                if (marks.length > 0) {
                    // Calculate statistics
                    const average = marks.reduce((sum, mark) => sum + mark, 0) / marks.length;
                    const highest = Math.max(...marks);
                    const lowest = Math.min(...marks);

                    // Update display
                    averageElement.textContent = average.toFixed(2);
                    highestElement.textContent = highest;
                    lowestElement.textContent = lowest;

                    // Show the statistics card
                    statsCard.style.display = 'block';
                } else {
                    // Hide the statistics card if no valid marks
                    statsCard.style.display = 'none';
                }
            }

            // Calculate initial statistics if there are existing values
            calculateStatistics();

            // Add event listeners for real-time calculation
            marksInputs.forEach(function(input) {
                input.addEventListener('input', calculateStatistics);
                input.addEventListener('change', calculateStatistics);
            });
        });
    </script>
    @endsection