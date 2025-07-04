@php
    $user = auth()->user();
@endphp

<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <!-- Logo (Mobile) -->
    <a href="#" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>

    <!-- Sidebar Toggler -->
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <!-- Navbar Right -->
    <div class="navbar-nav align-items-center ms-auto">
        <!-- Profil -->
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img src="{{ $user->foto ? asset('/storage/users/' . $user->foto) : asset('assets/img/user.jpg') }}"
                     alt="User Photo"
                     class="rounded-circle me-2"
                     style="width: 32px; height: 32px; object-fit: cover;">
                <span class="d-none d-lg-inline-flex">{{ $user->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
                <a href="{{ route('login.keluar') }}" class="dropdown-item">Log Out</a>
            </div>
        </div>

    </div>
</nav>
<!-- Navbar End -->
