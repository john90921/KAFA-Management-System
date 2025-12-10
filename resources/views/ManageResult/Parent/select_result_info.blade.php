<!-- resources/views/select_result_info.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="margin-bottom: 20px;"></div>
                <h3 class="text-center"><b>RESULT</b></h3><br>

                <div class="card-body">
                    <form method="GET" action="{{ route('resultslip') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="school_session" class="col-md-4 col-form-label text-md-right">Session Year</label>
                            <div class="col-md-6">
                                <select id="school_session" class="form-control @error('school_session') is-invalid @enderror" name="school_session">
                                    @foreach ($registeredYears as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                                @error('school_session')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;"></div>

                        <div class="form-group row">
                            <label for="exam_type" class="col-md-4 col-form-label text-md-right">Assessment Type</label>
                            <div class="col-md-6">
                                <select id="exam_type" class="form-control @error('exam_type') is-invalid @enderror" name="exam_type">
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

                        <div style="margin-bottom: 20px;"></div>

                        <div class="form-group row">
                            <label for="student_name" class="col-md-4 col-form-label text-md-right">Child's Name</label>
                            <div class="col-md-6">
                                <select id="student_name" class="form-control @error('student_name') is-invalid @enderror" name="student_name">
                                    @foreach ($children as $id => $student_name)
                                        <option value="{{ $id }}">{{ $student_name }}</option>
                                    @endforeach
                                </select>
                                @error('student_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;"></div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
