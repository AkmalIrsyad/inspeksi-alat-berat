@extends('layout.template')
@section('title','Daftar Artikel Panduan')
@section('content')

<div class="container mt-4">
    <h3 class="mb-4">📰 Daftar Artikel Panduan Komponen</h3>

    @forelse($artikels as $article)
        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($article->foto)
                        <img src="{{ asset('storage/' . $article->foto) }}"
                        class="img-fluid rounded-start h-100 w-100 object-fit-cover"
                        style="max-height: 200px; object-fit: cover;"
                        alt="{{ $article->judul }}">

                    @else
                        <img src="{{ asset('assets/img/no-image.png') }}"
                        class="img-fluid rounded-start h-100 w-100 object-fit-cover"
                        style="max-height: 200px; object-fit: cover;"
                        alt="No Image">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->judul }}</h5>
                        <p class="card-text">
                            {{ Str::limit(strip_tags($article->konten), 150, '...') }}
                        </p>
                        <a href="{{ route('inspektor.artikel.show', $article->id) }}" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada artikel yang tersedia.</div>
    @endforelse

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $artikels->links() }}
    </div>
</div>

@endsection
