@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Session</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('storeSession') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="school_session" class="col-md-4 col-form-label text-md-right">Session
                                Year</label>

                            <div class="col-md-6">
                                <select id="school_session"
                                    class="form-control @error('school_session') is-invalid @enderror"
                                    name="school_session">
                                    @for ($school_session = date('Y') - 1; $school_session <= date('Y') + 10; $school_session++)
                                        @if ($school_session == date('Y'))
                                            <option value="{{ $school_session }}" selected>{{ $school_session }}</option>
                                        @else
                                            <option value="{{ $school_session }}">{{ $school_session }}</option>
                                        @endif
                                    @endfor
                                </select>

                                @error('school_session')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Add a margin bottom of 20px to separate form groups -->
                        <div style="margin-bottom: 20px;"></div>

                        <div class="form-group row">
                            <label for="exam_type" class="col-md-4 col-form-label text-md-right">Assessment
                                Type</label>

                            <div class="col-md-6">
                                <select id="exam_type" class="form-control @error('exam_type') is-invalid @enderror"
                                    name="exam_type">
                                    <option value="Ujian Awal Tahun">Ujian Awal Tahun</option>
                                    <option value="Ujian Pertengahan Tahun">Ujian Pertengahan Tahun</option>
                                    <option value="Ujian Akhir Tahun">Ujian Akhir Tahun</option>
                                </select>

                                @error('exam_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Add a margin bottom of 20px to separate form groups -->
                        <div style="margin-bottom: 20px;"></div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Session
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Display list of sessions -->
            <div class="card">
                <div class="card-header">Sessions</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Session Year</th>
                                <th>Assessment Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through each examination to display its details -->
                            @foreach ($examination as $exam)
                                <tr>
                                    <td>{{ $exam->school_session }}</td>
                                    <td>{{ $exam->exam_type }}</td>
                                    <td>
                                        <form action="{{route('deletesession', $exam->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this session?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection