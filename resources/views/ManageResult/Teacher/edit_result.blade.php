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

        <!-- Real-Time Performance Statistics (for editing) -->
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
                    <strong>Note:</strong> Statistics update automatically as you edit marks.
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('editResult', ['assessid' => $assessment->id]) }}" enctype="multipart/form-data" id="editResultForm">
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
                                    <input type="number" 
                                           name="result_marks[{{$result->studentresult->id}}]" 
                                           value="{{ $result->result_marks }}" 
                                           min="0" 
                                           max="100" 
                                           required
                                           class="form-control marks-input"
                                           data-student-id="{{ $result->studentresult->id }}">
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

            // Calculate initial statistics
            calculateStatistics();

            // Add event listeners for real-time calculation
            marksInputs.forEach(function(input) {
                input.addEventListener('input', calculateStatistics);
                input.addEventListener('change', calculateStatistics);
            });
        });
    </script>
    @endsection