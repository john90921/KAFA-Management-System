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
                    <form method="POST" action="{{route('registerchild.create')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="child_ic" class="col-md-4 col-form-label text-md-end">{{ __('Identity Card Number') }}</label>

                            <div class="col-md-6">
                                <input id="child_ic" type="text" class="form-control @error('child_ic') is-invalid @enderror" name="child_ic" value="{{ old('child_ic') }}" required autocomplete="child_ic" autofocus>

                                @error('child_ic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="child_name" class="col-md-4 col-form-label text-md-end">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="child_name" type="text" class="form-control @error('child_name') is-invalid @enderror" name="child_name" value="{{ old('child_name') }}" required autocomplete="child_name">

                                @error('child_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="child_age" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="child_age" type="number" class="form-control @error('child_age') is-invalid @enderror" name="child_age" value="{{ old('child_age') }}" required autocomplete="child_age">

                                @error('child_age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="child_gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="child_gender" name="child_gender" class="form-select" aria-label="Default select example">
                                    <option selected value="null">Select</option>
                                    <option value="Men">Men</option>
                                    <option value="Women">Women</option>
                                </select>

                                @error('child_gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        

                        <div class="row mb-3 mt-2">
                            <label for="child_verification" class="col-md-4 col-form-label text-md-end">{{ __('Upload Identity Card') }}</label>
                            <div class="col-md-6">
                                <input id="child_verification" type="file" class="form-control @error('child_verification') is-invalid @enderror" name="child_verification" required>
                                @error('child_verification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn text-white fw-bold btn-primary">
                                    {{ __('Register Child') }}
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
