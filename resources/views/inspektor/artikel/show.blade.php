@extends('layout.template')
@section('title', 'Detail Artikel')
@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">📖 Detail Artikel</h3>
        <a href="{{ route('inspektor.artikel.index') }}" class="btn btn-sm btn-outline-secondary">
            ← Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm">
        @if($artikel->foto)
            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal">
                <img src="{{ asset('storage/' . $artikel->foto) }}"
                     class="card-img-top img-fluid"
                     style="max-height: 350px; object-fit: cover; cursor: zoom-in;"
                     alt="Foto Artikel">
            </a>
        @endif

        <div class="card-body">
            <h4 class="card-title mb-2">{{ $artikel->judul }}</h4>
            <div class="text-muted small mb-3">
                Dipublikasikan pada: {{ $artikel->created_at->format('d M Y') }}
            </div>

            <div class="card-text" style="line-height: 1.7">
                {!! $artikel->konten !!}
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk tampilkan gambar fullscreen --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body text-center p-0">
        <img src="{{ asset('storage/' . $artikel->foto) }}" class="img-fluid rounded" style="max-height: 90vh;">
      </div>
    </div>
  </div>
</div>

@endsection
