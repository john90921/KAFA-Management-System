@extends('layouts.master')

@section('content')

    <div class="container mt-3 mb-3">

    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" id="error-message">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    
        <div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div>
                        <form method="POST" action="{{ route('newactivity.create') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="subject_activity" class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>
    
                                <div class="col-md-6">
                                    <select id="subject_activity" name="subject_activity" class="form-select" aria-label="Default select example">
                                        <option selected value="null" >Select</option>

                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                    @endforeach

                                    </select>
    
                                    @error('subject_activity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="activity_name" class="col-md-4 col-form-label text-md-end">{{ __('Activity Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="activity_name" type="text" class="form-control @error('activity_name') is-invalid @enderror" name="activity_name" value="{{ old('activity_name') }}" required autocomplete="activity_name" autofocus>
    
                                    @error('activity_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="activity_description" class="col-md-4 col-form-label text-md-end">{{ __('Activity Description') }}</label>
                            
                                <div class="col-md-6">
                                    <textarea id="activity_description" class="form-control @error('activity_description') is-invalid @enderror" name="activity_description" required autocomplete="activity_description" autofocus>{{ old('activity_description') }}</textarea>
                            
                                    @error('activity_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="activity_date" class="col-md-4 col-form-label text-md-end">{{ __('Activity Date') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="activity_date" type="date" class="form-control @error('activity_date') is-invalid @enderror" name="activity_date" value="{{ old('activity_date') }}" required autocomplete="activity_date">
                            
                                    @error('activity_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="activity_starttime" class="col-md-4 col-form-label text-md-end">{{ __('Activity Start Time') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="activity_starttime" type="time" class="form-control @error('activity_starttime') is-invalid @enderror" name="activity_starttime" value="{{ old('activity_starttime') }}" required autocomplete="activity_starttime">
                            
                                    @error('activity_starttime')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="activity_endtime" class="col-md-4 col-form-label text-md-end">{{ __('Activity End Time') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="activity_endtime" type="time" class="form-control @error('activity_endtime') is-invalid @enderror" name="activity_endtime" value="{{ old('activity_endtime') }}" required autocomplete="activity_endtime">
                            
                                    @error('activity_endtime')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="activity_remarks" class="col-md-4 col-form-label text-md-end">{{ __('Activity Remarks') }}</label>
    
                                <div class="col-md-6">
                                    <select id="activity_remarks" name="activity_remarks" class="form-select" aria-label="Default select example">
                                        <option selected value="null">Select</option>
                                        <option value="Subject">Subject</option>
                                        <option value="Event">Event</option>
                                    </select>
    
                                    @error('activity_remarks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-check d-flex justify-content-end" style="margin-top: -15px; margin-bottom: 15px">
                                <label class="form-check-label" for="flexCheckChecked">
                                    <small><i>*Event is a class event for that day, Subject is what shall student learn*</i></small>
                                </label>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn text-white fw-bold btn-primary" id="submitButton">
    
                                        {{ __('Add') }}
                                    </button>
    
                                @foreach (range(1, 5) as $index)
                                    &nbsp;
                                @endforeach
    
                                    <button type="reset" class="btn text-white fw-bold btn-danger">
                                        {{ __('Reset') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection