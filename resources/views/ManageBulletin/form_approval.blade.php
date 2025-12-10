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
                    <br><br>
                    <form id="status-form" method="POST" action="{{ route('updatestatus', $notice->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" id="action-input" value="">
                        <div class="d-flex justify-content-center">
                            <div>
                                <button type="button" class="btn btn-success" onclick="submitForm('Approve')">
                                    {{ __('Approve') }}
                                </button>

                                &nbsp;

                                <button type="button" class="btn btn-danger" onclick="submitForm('Reject')">
                                    {{ __('Reject') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <script>
                        function submitForm(action) {
                            document.getElementById('action-input').value = action;
                            document.getElementById('status-form').submit();
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection