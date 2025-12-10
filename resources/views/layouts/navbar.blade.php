@php
    $navbarstyle = null;
    
    $userRole = auth()->user();
    $isMUIPAdmin = $userRole->role_id == 1;
    $isKAFAAdmin = $userRole->role_id == 2;
    $isParent = $userRole->role_id == 3;
    $isTeacher = $userRole->role_id == 4;
    
    if ($isMUIPAdmin) {
        $navbarstyle = 'navbarstyle-1';
    } elseif($isKAFAAdmin) {
        $navbarstyle = 'navbarstyle-2';
    } elseif($isParent) {
        $navbarstyle = 'navbarstyle-3';
    } elseif($isTeacher) {
        $navbarstyle = 'navbarstyle-4';
    }

    $imageprofile = $userRole->user_gender === 'Men' ? 'man.png' : ($userRole->user_gender === 'Women' ? 'woman.png' : 'mantantersakiti.jpeg');
@endphp

<nav class="navbar fixed-top {{ $navbarstyle }}">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <a class="navbar-brand ms-md-3" href="/home">
                <img src="{{ asset('default_image/kafa-logo.png') }}" alt="kafahome.jpeg" width="45" height="50">
            </a>
            <p class="h4 fw-bold text-dark m-0">Kafa Management System</p>
        </div>
        <div class="d-flex align-items-center">
            <img src="{{ asset('default_image/'. $imageprofile) }}" alt="profile.png" width="45" height="45" class="rounded-circle me-2">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $userRole->user_name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>        
    </div>
</nav>