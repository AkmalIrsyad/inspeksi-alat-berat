@extends('layout.template')

@section('title', isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel')

@section('content')
<div class="container mt-4">
    <h3>{{ isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel' }}</h3>

    <form action="{{ isset($artikel) ? route('artikels.update', $artikel->id) : route('artikels.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($artikel)) @method('PUT') @endif

        {{-- Judul --}}
        <div class="mb-3">
            <label for="title" class="form-label">Judul Artikel</label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                   value="{{ old('judul', $artikel->judul?? '') }}" placeholder="Masukkan judul artikel">
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

       {{-- Konten --}}
        <div class="mb-3">
            <label for="konten" class="form-label">Konten</label>
            <input id="konten" type="hidden" name="konten" value="{{ old('konten', $artikel->konten ?? '') }}">
            <trix-editor input="konten" class="@error('konten') is-invalid @enderror"></trix-editor>
            @error('konten')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        {{-- Gambar --}}
        <div class="mb-3">
            <label for="foto" class="form-label">Gambar</label>
            @if(isset($artikel) && $artikel->foto)
                <div class="mb-2">
                    {{-- Gambar klik untuk fullscreen --}}
                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('storage/' . $artikel->foto) }}" alt="Gambar Artikel"
                            class="img-thumbnail" style="max-height: 150px; cursor: zoom-in;">
                    </a>
                </div>
            @endif
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <button type="submit" class="btn btn-success">
            {{ isset($artikel) ? 'Update' : 'Simpan' }}
        </button>
        <a href="{{ route('artikels.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
    {{-- Modal Gambar Fullscreen --}}
@if(isset($artikel) && $artikel->foto)
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body text-center p-0">
                    <img src="{{ asset('storage/' . $artikel->foto) }}" class="img-fluid rounded" style="max-height: 90vh;" alt="Full Gambar">
                </div>
            </div>
        </div>
    </div>
@endif
</div>
@endsection

