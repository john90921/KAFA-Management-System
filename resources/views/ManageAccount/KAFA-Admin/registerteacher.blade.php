@extends('layouts.master')

@section('content')

    <div class="container">

    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif

        <div class="row justify-content-center mt-3 mb-3">
            <div class="col-md-8">
                <div>
                    <form method="POST" action="{{ route('registerteacher.create') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Identity Card Number') }}</label>

                            <div class="col-md-6">
                                <input id="user_ic" type="text" class="form-control @error('user_ic') is-invalid @enderror" name="user_ic" value="{{ old('user_ic') }}" required autocomplete="user_ic" autofocus>

                                @error('user_ic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="user_name" class="col-md-4 col-form-label text-md-end">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name">

                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="user_gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="user_gender" name="user_gender" class="form-select" aria-label="Default select example">
                                    <option selected value="null">Select</option>
                                    <option value="Men">Men</option>
                                    <option value="Women">Women</option>
                                </select>

                                @error('user_gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        

                        <div class="row mb-3">
                            <label for="user_contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                                <input id="user_contact" type="text" class="form-control @error('user_contact') is-invalid @enderror" name="user_contact" value="{{ old('user_contact') }}" required autocomplete="user_contact">

                                @error('user_contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-check d-flex justify-content-end" style="margin-top: -15px;">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">&nbsp;
                            <label class="form-check-label" for="flexCheckChecked">
                                Set Password As IC Number
                            </label>
                        </div>

                        <div class="row mb-3 mt-2">
                            <label for="user_verification" class="col-md-4 col-form-label text-md-end">{{ __('Upload Identity Card') }}</label>
                            <div class="col-md-6">
                                <input id="user_verification" type="file" class="form-control @error('user_verification') is-invalid @enderror" name="user_verification" required>
                                @error('user_verification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn text-white fw-bold btn-primary">
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

@endsection
