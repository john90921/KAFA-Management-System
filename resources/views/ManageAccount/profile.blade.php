@extends('layouts.master')

@section('content')

    <div class="container mt-3 mb-3">

    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif
    
        <div class="row justify-content-center">
            <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>

                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Identity Card Number') }}</label>
            
                            <div class="col-md-4">
                                <input id="user_ic" type="text" class="form-control @error('user_ic') is-invalid @enderror" name="user_ic" value="{{ old('user_ic', $user->user_ic) }}" placeholder="User IC" required>
                                @error('user_ic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>
        
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="user_name" class="col-md-4 col-form-label text-md-end">{{ __('Full Name') }}</label>
            
                            <div class="col-md-4">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name', $user->user_name) }}" placeholder="User Name" required>
                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="user_gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
            
                            <div class="col-md-4">
                                <select id="user_gender" name="user_gender" class="form-select" aria-label="Gender">
                                    <option value="Men" {{ $user->user_gender === 'Men' ? 'selected' : '' }}>Men</option>
                                    <option value="Women" {{ $user->user_gender === 'Women' ? 'selected' : '' }}>Women</option>
                                </select>
                            </div>                        
                        </div>
                    </div>
        
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="user_contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>
            
                            <div class="col-md-4">
                                <input id="user_contact" type="text" class="form-control @error('user_contact') is-invalid @enderror" name="user_contact" value="{{ old('user_contact', $user->user_contact) }}" placeholder="User Contact" required>
                                @error('user_contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
            
                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div class="col-md-12">
                        <div class="row mb-3">
                            
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
            
                            <div class="col-md-4">
                                <input id="password" type="text" class="form-control" name="password" placeholder="**********" required disabled>
                                <small class="text-muted">Password is hashed and cannot be displayed.</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="user_verification" class="col-md-4 col-form-label text-md-end">{{ __('New Identity Card Verification') }}</label>
            
                            <div class="col-md-4">
                                <input id="user_verification" type="file" class="form-control" name="user_verification" placeholder="User Verification">
                                @if($user->user_verification)
                                    <small><a href="{{ asset('storage/' . $user->user_verification) }}" download>View Current Verification</a></small>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="new_password" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

                            <div class="col-md-4">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="New Password">
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            
                            <div class="col-md-4">
                                <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" placeholder="Confirm Password">
                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary fw-bold">Update</button>

                @foreach (range(1, 5) as $index)
                    &nbsp;
                @endforeach
                
                    <button type="reset" class="btn btn-danger fw-bold">Reset</button>
                </div>
            </form>
        </div>
    </div>

@endsection