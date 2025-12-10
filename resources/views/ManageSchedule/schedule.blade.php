<div class="container">
    <h1 class="text-center">Weekly Timetable of {{ $class->class_name }}</h1>
    <table class="table table-bordered" id="timetable">
        <thead>
            <tr>
                <th>Time</th>

            @foreach($nextDates as $date)
                <th>{{ $date }}</th>
            @endforeach

            </tr>
        </thead>
        <tbody>

        @php
            $startTime = \Carbon\Carbon::parse('2:00 PM');
            $endTime = \Carbon\Carbon::parse('6:00 PM');
            $timeIncrement = $startTime->copy();
        @endphp
        @while ($timeIncrement < $endTime)
            <tr>
                <td>{{ $timeIncrement->format('h:i A') }} - {{ $timeIncrement->addMinutes(30)->format('h:i A') }}</td>

                @foreach ($nextDates as $date)
                    <td>

                        @foreach ($activities as $activity)
                            @if ($activity->activity_date == $date && 
                                \Carbon\Carbon::parse($activity->activity_endtime)->between(
                                    \Carbon\Carbon::parse($timeIncrement)->addMinutes(30), 
                                    \Carbon\Carbon::parse($timeIncrement)
                                ))
                                {{ $activity->subject->subject_name }}
                                <br>
                                <small>
                                @if (auth()->user()->role_id == 4)
                                    <a href="{{ route('activitydetails', ['id' => $activity->id]) }}" id="linksetup">{{ $activity->activity_name }}</a>
                                @else
                                    {{ $activity->activity_name }}
                                @endif
                                </small>
                            @endif
                        @endforeach

                    </td>
                @endforeach

            </tr>
        @endwhile

        </tbody>
    </table>
</div>