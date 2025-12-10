@extends('layouts.master')

@section('content')

    <div class="text-center mt-4">
        <div>
            <p class="h2 fw-bold">Welcome back, {{ $user->user_name }}</p>
        </div>
        <div>
            <img src="{{ asset('default_image/kafa-logo.png') }}" class="rounded homekafa" alt="matriye.jpeg">
        </div>
    </div>
    
@endsection