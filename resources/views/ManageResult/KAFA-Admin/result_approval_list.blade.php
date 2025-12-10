@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center"><b>RESULT SUBMISSION APPROVAL</b></h3>
                </div>

                <div style="margin-bottom: 20px;"></div>

                <form action="{{ route('resultapprovallist') }}" method="get">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <div class="form-group row">
                                <label for="school_session" class="col-md-6 col-form-label text-md-right">Session Year</label>
                                <div class="col-md-6">
                                    <select id="school_session" class="form-control @error('school_session') is-invalid @enderror" name="school_session">
                                        @for ($school_session = date('Y') - 0; $school_session <= date('Y') + 10; $school_session++)
                                            <option value="{{ $school_session }}" {{ request('school_session') == $school_session ? 'selected' : '' }}>{{ $school_session }}</option>
                                        @endfor
                                    </select>
                                    @error('school_session')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;
                            <div style="margin-bottom: 20px;"></div>

                            <div class="form-group row">
                                <label for="exam_type" class="col-md-4 col-form-label text-md-right">Assessment Type</label>
                                <div class="col-md-6">
                                    <select id="exam_type" class="form-control @error('exam_type') is-invalid @enderror" name="exam_type">
                                        <option value="Ujian Awal Tahun" {{ request('exam_type') == 'Ujian Awal Tahun' ? 'selected' : '' }}>Ujian Awal Tahun</option>
                                        <option value="Ujian Pertengahan Tahun" {{ request('exam_type') == 'Ujian Pertengahan Tahun' ? 'selected' : '' }}>Ujian Pertengahan Tahun</option>
                                        <option value="Ujian Akhir Tahun" {{ request('exam_type') == 'Ujian Akhir Tahun' ? 'selected' : '' }}>Ujian Akhir Tahun</option>
                                    </select>
                                    @error('exam_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Session</th>
                                    <th>Assessment</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $index => $result)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $result->examination->school_session }}</td>
                                        <td>{{ $result->examination->exam_type }}</td>
                                        <td>{{ $result->studentresult->classroom->class_name }}</td>
                                        <td>{{ $result->subject->subject_name }}</td>
                                        <td>
                                        {{$result->result_status}}
                                        </td>
                                        <td>
                                            <a href="{{ route('studentlistreview', ['result_id' => $result->id]) }}" class="btn btn-outline-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <p>&copy; 2024 KAFA Management System</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
