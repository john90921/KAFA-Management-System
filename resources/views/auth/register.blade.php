@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="mb-3">
            <img src="{{ asset('default_image/kafa-logo.png') }}" class="rounded mx-auto d-block frontimage2" alt="kafalogo.jpeg">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="icnumber" class="col-md-4 col-form-label text-md-end">{{ __('Identity Card Number') }}</label>

                                <div class="col-md-6">
                                    <input id="icnumber" type="text" class="form-control @error('icnumber') is-invalid @enderror" name="icnumber" value="{{ old('icnumber') }}" required autocomplete="icnumber" autofocus>

                                    @error('icnumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Full Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                                <div class="col-md-6">
                                    <select id="gender" name="gender" class="form-select" aria-label="Default select example">
                                        <option selected value="null">Select</option>
                                        <option value="Men">Men</option>
                                        <option value="Women">Women</option>
                                    </select>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                        

                            <div class="row mb-3">
                                <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>

                                <div class="col-md-6">
                                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact">

                                    @error('contact')
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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="ic_docs" class="col-md-4 col-form-label text-md-end">{{ __('Upload Identity Card') }}</label>
                                <div class="col-md-6">
                                    <input id="ic_docs" type="file" class="form-control @error('ic_docs') is-invalid @enderror" name="ic_docs" required>
                                    @error('ic_docs')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn text-white fw-bold reglog_button">
                                        {{ __('Register') }}
                                    </button>

                                @foreach (range(1, 5) as $index)
                                    &nbsp;
                                @endforeach

                                    <button type="reset" class="btn text-white fw-bold reset_button">
                                        {{ __('Reset') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <a href="{{ route('login') }}" class="btn text-white fw-bold reglog_button">
                                    {{ __('Login') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
