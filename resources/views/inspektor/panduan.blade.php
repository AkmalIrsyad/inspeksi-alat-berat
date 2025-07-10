@extends('layout.template')
@section('title','Panduan Komponen Umum')
@section('content')

<div class="container mt-4">
    <h3 class="mb-4">📘 Panduan Komponen Umum Alat Berat</h3>

        <div class="card mb-4 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('assets/panduan/forklift.jpg') }}" class="img-fluid rounded-start" alt="Forklift">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Forklift</h5>
                    <p class="card-text">
                        Forklift memiliki komponen utama seperti <strong>tiang (mast)</strong>, <strong>garpu (fork)</strong>,
                        <strong>counterweight</strong>, dan sistem <strong>hidrolik</strong>. Fungsinya untuk mengangkat dan
                        memindahkan barang dalam gudang atau pabrik.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('assets/panduan/wheel-loader.jpg') }}" class="img-fluid rounded-start" alt="Wheel Loader">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Wheel Loader</h5>
                    <p class="card-text">
                        Komponen umum pada wheel loader meliputi <strong>bucket</strong>, <strong>boom arm</strong>,
                        <strong>knuckle</strong>, dan <strong>roda berukuran besar</strong>. Digunakan untuk memindahkan material
                        seperti pasir, tanah, atau batu.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('assets/panduan/excavator.jpg') }}" class="img-fluid rounded-start" alt="Excavator">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Excavator</h5>
                    <p class="card-text">
                        Excavator terdiri dari <strong>boom</strong>, <strong>stick</strong>, <strong>bucket</strong>, dan
                        <strong>cab (kabin)</strong>. Alat ini berfungsi untuk menggali tanah, mengangkat beban, dan pekerjaan
                        berat lainnya di proyek konstruksi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
