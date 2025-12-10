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
                    <form method="POST" action="{{ route('activitydetails.update', ['id' => $activity->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="subject" class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>
                        
                            <div class="col-md-6">
                                <select id="subject" name="subject" class="form-select" aria-label="Default select example">

                            @foreach ($subjects as $subs)
                                @if ($subs->id == $subject)
                                    <option value="{{ $subs->id }}" selected>{{ $subs->subject_name }}</option>
                                @else
                                    <option value="{{ $subs->id }}">{{ $subs->subject_name }}</option>
                                @endif
                            @endforeach
                                
                                </select>
                        
                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="activity_name" class="col-md-4 col-form-label text-md-end">{{ __('Activity Name') }}</label>

                            <div class="col-md-6">
                                <input id="activity_name" type="text" class="form-control @error('activity_name') is-invalid @enderror" name="activity_name" value="{{ old('activity_name', $activity->activity_name) }}" required autocomplete="activity_name" autofocus>

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
                                <textarea id="activity_description" class="form-control @error('activity_description') is-invalid @enderror" name="activity_description" required autocomplete="activity_description" autofocus>{{ old('activity_description', $activity->activity_description) }}</textarea>
                                                    
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
                                <input id="activity_date" type="date" class="form-control @error('activity_date') is-invalid @enderror" name="activity_date" value="{{ old('activity_date', $activity->activity_date) }}" required autocomplete="activity_date">
                        
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
                                <input id="activity_starttime" type="time" class="form-control @error('activity_starttime') is-invalid @enderror" name="activity_starttime" value="{{ old('activity_starttime', $activity->activity_starttime) }}" required autocomplete="activity_starttime">
                        
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
                                <input id="activity_endtime" type="time" class="form-control @error('activity_endtime') is-invalid @enderror" name="activity_endtime" value="{{ old('activity_endtime', $activity->activity_endtime) }}" required autocomplete="activity_endtime">
                        
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
                                    <option value="Select" {{ $activity->activity_remarks == 'Select' ? 'selected' : '' }}>Select</option>
                                    <option value="Subject" {{ $activity->activity_remarks == 'Subject' ? 'selected' : '' }}>Subject</option>
                                    <option value="Event" {{ $activity->activity_remarks == 'Event' ? 'selected' : '' }}>Event</option>
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
                                    <button type="submit" class="btn text-white fw-bold btn-info" id="submitButton">

                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="col-md-6 offset-md-6" style="margin-top: -37.8px">
                        <form action="{{ route('activitydetails.delete', ['id' => $activity->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn text-white fw-bold btn-danger" data-target="#confirmDelete">
                                {{ __('Delete') }}
                            </button>

                            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="confirmNotDelete" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this activity? This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="confirmNotDelete2">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection