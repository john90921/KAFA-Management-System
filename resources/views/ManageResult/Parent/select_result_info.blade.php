<!-- resources/views/select_result_info.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container mt-3 mb-3">
    @if(session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif
    @if(session('message'))
        <div class="alert alert-success" id="success-message">
            {{ session('message') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0"><b><i class="fas fa-graduation-cap"></i> VIEW CHILD'S RESULT</b></h3>
                </div>

                <div class="card-body">
                    <p class="text-muted text-center">Please select the examination details and your child to view their results.</p>
                    <hr>

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
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-search"></i> View Results
                                </button>
                            </div>
                        </div>
                    </form>

                    @if($children->isEmpty())
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <strong>No children registered.</strong> Please register your child first.
                        </div>
                    @endif

                    @if(empty($registeredYears))
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle"></i> 
                            <strong>No examination sessions available.</strong> Please contact the school administration.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
