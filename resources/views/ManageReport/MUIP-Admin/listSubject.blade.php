@extends('layouts.master')

@section('content')
    <div>
        <div class="card-header">
                <h3>REPORT>LIST OF SUBJECTS</h3>
        </div><br>

        <div class="col-12 col-xl-6">
            <div class="card">

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>List of Subjects</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td>{{ $subject->subject_name }}</td>
                            <td class="text-end">
                                <a href="{{route('searchExam', ['id' => $subject->id])}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="{{ route('listFeedback') }}" class="btn btn-primary btn-sm">
                        {{ __('Feedback') }}
                    </a>
                </div>

            </div>
        </div>



















    </div>
@endsection