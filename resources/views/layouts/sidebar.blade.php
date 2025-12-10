@php
    $userRole = auth()->user();
    $isMUIPAdmin = $userRole->role_id == 1;
    $isKAFAAdmin = $userRole->role_id == 2;
    $isParent = $userRole->role_id == 3;
    $isTeacher = $userRole->role_id == 4;

    $btncolor = null;
    $activeColor = null;

    if ($isMUIPAdmin) {
        $btncolor = 'btn-danger';
        $activeColor = $btncolor . ' active';
    } elseif ($isKAFAAdmin) {
        $btncolor = 'btn-primary';
        $activeColor = $btncolor . ' active';
    } elseif ($isParent) {
        $btncolor = 'btn-warning';
        $activeColor = $btncolor . ' active';
    } elseif ($isTeacher) {
        $btncolor = 'btn-success';
        $activeColor = $btncolor . ' active';
    }
@endphp

<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mt-5">

            {{-- USE BY ALL USER --}}
            <a href="{{ route('home') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Home</a>
            <a href="{{ route('profile') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Profile</a>

            @if ($isMUIPAdmin)
                {{-- MUIP Admin --}}
                <a href="{{ route('listSubject') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Report Subject</a>
                <a href="{{ route('infoReport') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Report Class</a>
                <a href="{{ route('allnotices') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Notice</a>

            @elseif($isKAFAAdmin)
                {{-- KAFA Admin --}}
                <a href="{{ route('registerteacher') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Add Teacher</a>
                <a href="{{ route('allclass') }}" class="list-group-item btn {{ $btncolor }} btn-lg">All Class</a>
                <a href="{{ route('addsession') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Create Session</a>
                <a href="{{ route('resultapprovallist') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Result</a>
                <a href="{{ route('listFeedback') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Report</a>
                <a href="{{ route('allnotices') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Notice</a>

            @elseif($isParent)
                {{-- Parent --}}
                <a href="{{ route('registerchild') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Register Child</a>
                <a href="{{ route('childkafa') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Child Activity</a>
                <a href="{{ route('selectresultinfo') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Result</a>
                
            @elseif($isTeacher)
                {{-- Teacher --}}
                <a href="{{ route('classactivity') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Manage Class</a>
                <a href="{{ route('assessmentdetails') }}" class="list-group-item btn {{ $btncolor }} btn-lg">KAFA Assessment</a>
                <a href="{{ route('allnotices') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Notice</a>                
            @endif

            {{-- USE BY ALL USER --}}
            <a href="{{ route('bulletinboard') }}" class="list-group-item btn {{ $btncolor }} btn-lg">Bulletin Board</a>

        </div>
    </div>
</nav>