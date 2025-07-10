@extends('layout.template') {{-- atau layout sesuai struktur kamu --}}

@section('title', '404 Not Found')

@section('content')
<div class="text-center mt-5">
    <h1 class="display-1">404</h1>
    <p class="fs-4">Halaman tidak ditemukan.</p>

    @php
        $route = '/'; // default fallback

        if (auth()->check()) {
            if (auth()->user()->role === 'inspektor') {
                $route = route('inspektor.index');
            } elseif (auth()->user()->role === 'supervisor') {
                $route = route('supervisor.index');
            }
        }
    @endphp

    <a href="{{ $route }}" class="btn btn-primary">← Kembali ke Dashboard</a>
</div>
@endsection
