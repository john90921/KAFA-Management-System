@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div style="border: 1px solid black; background-color: #f2f2f2; padding: 10px; margin-bottom: 10px;">
                <div style="padding-left: 10px; padding-right: 10px; margin-top: 10px;">
                    <b style="text-transform: uppercase;">{{ $notice->notice_title }}</b>
                    <br>
                    <div style="margin-top: 10px;">
                        {{ $notice->notice_text }}
                    </div>

                    @if ($notice->notice_poster!='path')
                    <div style="margin-top: 10px;">
                        <img src="{{ asset('storage/' . $notice->notice_poster) }}" alt="Notice Poster" style="max-width: 100%;">
                    </div>
                    @endif
                    <br><br>
                    <div>
                        <b>Author:</b> {{ $user }}
                    </div>
                    <div style="text-align: right; margin-top: -33px; margin-bottom: 10px;">
                        <a href="{{ route('bulletinboard') }}" class="btn btn-secondary" style="margin-right: 10px;">
                            {{ __('Close') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection