@php
    $user = auth()->user();
@endphp

<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="#" class="navbar-brand mx-4 mb-3">
            <h6 class="text-primary"><i class="fa fa-hashtag me-2"></i>Walk Around Inspection</h6>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img src="{{ $user->foto ? asset('/storage/users/' . $user->foto) : asset('assets/img/user.jpg') }}" class="rounded-circle" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ $user->name }}</h6>
                <span>{{ ucfirst($user->role) }}</span>
            </div>
        </div>

        <div class="navbar-nav w-100">
            @if ($user->role === 'supervisor')
                <a href="{{ route('supervisor.index') }}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="{{ route('users') }}" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Manajemen User</a>
                <a href="{{ route('supervisor.inspeksi.index') }}" class="nav-item nav-link"><i class="fa fa-check-circle me-2"></i>Cek Inspeksi</a>
                <a href="{{ route('alat-berat') }}" class="nav-item nav-link"><i class="fa fa-snowplow me-2"></i>Alat Berat</a>
                <a href="{{ route('komponen') }}" class="nav-item nav-link"><i class="fa fa-tools me-2"></i>Komponen</a>
                <a href="{{ route('artikels.index') }}" class="nav-item nav-link"><i class="fa fa-sign me-2"></i>Artikel Panduan</a>
                <a href="{{ route('supervisor.profile.edit') }}" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Edit Profil</a>
            @elseif ($user->role === 'inspector')
                <a href="{{ route('inspektor.index') }}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="{{ route('inspeksi') }}" class="nav-item nav-link"><i class="fa fa-history me-2"></i>Riwayat Inspeksi</a>
                <a href="{{ route('inspeksi.create') }}" class="nav-item nav-link"><i class="fa fa-wrench me-2"></i>Inspeksi</a>
                <a href="{{ route('inspektor.artikel.index') }}" class="nav-item nav-link"><i class="fa fa-sign me-2"></i>Artikel Panduan</a>
                <a href="{{ route('inspektor.profile.edit') }}" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Edit Profile</a>
            @endif
            <a href="{{ route('login.keluar') }}" class="nav-item nav-link text-danger"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
