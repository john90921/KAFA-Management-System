@extends('layouts.master')

@section('content')
<br>
<h3 style="margin-left: 20px;"><b>BULLETIN BOARD</b></h3>
<br>

<div class="container">
    @foreach($notices as $notice)
    @if($notice->notice_status == 'Approved')
    <div class="row">
        <div class="col">
            <div style="border: 1px solid black; background-color: #f2f2f2; padding: 10px; margin-bottom: 10px;">
                <div style="padding-left: 10px; padding-right: 10px; margin-top: 10px;">
                    <b style="text-transform: uppercase;">{{ $notice->notice_title }}</b>
                    <br>
                    <div style="margin-top: 10px;">
                        {{ $notice->notice_text }}
                    </div>
                    <div style="text-align: right; margin-top: 10px; margin-bottom: 10px;">
                        <a href="{{ route('selectednotices', ['id' => $notice->id]) }}" class="btn btn-primary" style="margin-right: 10px;">
                            {{ __('View') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <br><br>
</div>
@endsection