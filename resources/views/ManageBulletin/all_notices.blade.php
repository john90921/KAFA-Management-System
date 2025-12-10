@extends('layouts.master')

@section('content')
@php
$userRole=auth()->user();
@endphp
<div>
    @if(session('message'))
    <div class="alert alert-info" id="success-message">
        {{ session('message') }}
    </div>
    @endif

    <br>
    <div class="container mt-3">
        <div class="row d-flex align-items-center justify-content-between">
            <div class="col-auto">
                <h2 class="mb-0" style="margin-left: 20px;"><b>NOTICE</b></h2>
            </div>
            <div class="col-auto d-flex align-items-center">
                <a href="{{ route('noticeform') }}" class="btn btn-primary btn-lg">
                    {{ __('Create') }}
                </a>
                &nbsp;&nbsp;&nbsp;
                @if ($userRole->role_id == 4 || $userRole->role_id == 2)
                <form id="filterForm" method="GET" action="{{ route('allnotices') }}">
                    <select name="notice_status" class="form-select btn-lg" aria-label="Default select example"
                        onchange="this.form.submit()">
                        <option @if ($status=="null" ) selected @endif value="All">All</option>
                        <option @if ($status=='Pending' ) selected @endif value="Pending">Pending</option>
                        <option @if ($status=='Approved' ) selected @endif value="Approved">Approved</option>
                        <option @if ($status=='Rejected' ) selected @endif value="Rejected">Rejected</option>
                    </select>
                </form>
                @endif
            </div>
        </div>
    </div>


    <br><br>
    @if($notices->isEmpty())
    <p class="h4 fw-bold">No notices found.</p>
    @else
    <div class="container">
        <div class="row align-items-start">
            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                <b>Title</b>
            </div>
            @if($userRole->role_id == 2)
            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                <b>Author</b>
            </div>
            @endif
            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                <b>Apply Date</b>
            </div>

            @if($userRole->role_id == 4 || $userRole->role_id == 2)
            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                <b>Status</b>
            </div>
            @endif

            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                <b>Action</b>
            </div>
        </div>
        <br><br>

        @foreach($notices as $notice)
        @if($userRole->role_id == 2 || ($userRole->role_id == 1 && $notice->user_id == $userRole->id) ||
        ($userRole->role_id == 4 && $notice->user_id == $userRole->id))
        <div class="row mb-3">
            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                {{ $notice->notice_title }}
            </div>
            @if($userRole->role_id == 2)
            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                {{ $notice->user->user_name }}
            </div>
            @endif
            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                {{ \Carbon\Carbon::parse($notice->notice_submission_date)->format('j F Y') }}
            </div>
            @if($userRole->role_id == 4 || $userRole->role_id == 2)
            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                {{ $notice->notice_status }}
            </div>
            @endif
            <div class="col text-center d-flex align-items-center justify-content-center"
                style="border: 1px solid black; height: 40px; background-color: #f2f2f2;">
                @if($userRole->role_id == 2)
                @if ($notice->notice_status == "Approved")
                <button class="btn btn-warning btn-sm" disabled>
                    <i class="bi bi-eye"></i>
                </button>
                @elseif ($notice->notice_status == "Rejected")
                <button class="btn btn-warning btn-sm" disabled>
                    <i class="bi bi-eye"></i>
                </button>
                @else
                <a href="{{ route('formapproval', ['id' => $notice->id]) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-eye"></i>
                </a>
                @endif
                &nbsp;&nbsp;
                @endif
                <form action="{{ route('deletenotice', $notice->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this notice?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @endif
</div>
@endsection