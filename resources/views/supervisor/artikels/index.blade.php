@extends('layout.template')
@section('title', 'Daftar Artikel Panduan')
@section('content')

<div class="container mt-4">
     @if (session()->has('success'))
     <div class="alert alert-success" role="alert">
     {{ session('success') }}
        </div>
                @endif
    <h3 class="mb-4">📘 Daftar Artikel Panduan</h3>

    <a href="{{ route('artikels.create') }}" class="btn btn-primary mb-3">➕ Tambah Artikel</a>

    @forelse($artikels as $data)
        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($data->foto)
                        <img src="{{ asset('storage/' . $data->foto) }}"
                        class="img-fluid rounded-start h-100 w-100 object-fit-cover"
                        style="max-height: 200px; object-fit: cover;"
                        alt="{{ $data->judul }}">
                    @else
                        <img src="{{ asset('assets/img/no-image.png') }}"
                        class="img-fluid rounded-start h-100 w-100 object-fit-cover"
                        style="max-height: 200px; object-fit: cover;"
                        alt="No Image">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $data->judul }}</h5>
                        <p class="card-text text-muted">{{ Str::limit(strip_tags($data->konten), 150, '...') }}</p>
                        <div class="mt-3">
                            <a href="{{ route('artikels.edit', $data->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                            <form action="{{ route('artikels.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada artikel yang tersedia.</div>
    @endforelse

    <div class="d-flex justify-content-center">
        {{ $artikels->links() }}
    </div>
</div>
@endsection
