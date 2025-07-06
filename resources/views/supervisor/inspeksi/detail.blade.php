@extends('layout.template')
@section('title','Detail Inspeksi - Walk Around Inspection')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="text-primary mb-1">
                        <i class="fas fa-clipboard-check me-2"></i>
                        Detail Inspeksi
                    </h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('supervisor.inspeksi.index') }}" class="text-decoration-none">
                                    <i class="fas fa-list me-1"></i>Daftar Inspeksi
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Detail Inspeksi</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('supervisor.inspeksi.exportPdf', $inspeksi->id) }}"
                       class="btn btn-danger me-2">
                        <i class="fas fa-file-pdf me-1"></i>
                        Export PDF
                    </a>
                    <a href="{{ route('supervisor.inspeksi.index') }}"
                       class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>
                        Kembali
                    </a>
                </div>
            </div>

            {{-- Informasi Inspeksi --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Informasi Inspeksi
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 mb-3">
                                    <div class="border-start border-primary border-4 ps-3">
                                        <h6 class="text-muted mb-1">
                                            <i class="fas fa-user me-1"></i>
                                            Nama Inspektor
                                        </h6>
                                        <p class="mb-0 fw-semibold fs-5">{{ $inspeksi->user->name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-3">
                                    <div class="border-start border-info border-4 ps-3">
                                        <h6 class="text-muted mb-1">
                                            <i class="fas fa-excavator me-1"></i>
                                            Alat Berat
                                        </h6>
                                        <p class="mb-0 fw-semibold fs-5">
                                            {{ $inspeksi->alatBerat->merk }}
                                            <span class="badge bg-secondary ms-2">{{ $inspeksi->alatBerat->serial_number }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-3">
                                    <div class="border-start border-{{ $inspeksi->status == 'Approved' ? 'success' : 'warning' }} border-4 ps-3">
                                        <h6 class="text-muted mb-1">
                                            <i class="fas fa-chart-line me-1"></i>
                                            Status Umum
                                        </h6>
                                        <p class="mb-0">
                                            <span class="badge bg-{{ $inspeksi->status == 'Approved' ? 'success' : 'warning' }} fs-6">
                                                <i class="fas fa-{{ $inspeksi->status == 'Approved' ? 'check-circle' : 'exclamation-triangle' }} me-1"></i>
                                                {{ $inspeksi->status }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-3">
                                    <div class="border-start border-dark border-4 ps-3">
                                        <h6 class="text-muted mb-1">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            Tanggal Inspeksi
                                        </h6>
                                        <p class="mb-0 fw-semibold fs-5">
                                            {{ $inspeksi->created_at->format('d M Y') }}
                                            <small class="text-muted ms-2">
                                                ({{ $inspeksi->created_at->format('H:i') }} WIB)
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Komponen --}}
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-cogs me-2"></i>
                                Detail Komponen ({{ $inspeksi->komponens->count() }} Item)
                            </h5>
                            <div>
                                @php
                                    $statusOK = $inspeksi->komponens->where('pivot.status', 'OK')->count();
                                    $statusNO = $inspeksi->komponens->where('pivot.status', 'NO')->count();
                                @endphp
                                <span class="badge bg-success me-1">
                                    <i class="fas fa-check me-1"></i>OK: {{ $statusOK }}
                                </span>
                                <span class="badge bg-danger">
                                    <i class="fas fa-times me-1"></i>NO: {{ $statusNO }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5%;" class="text-center">#</th>
                                            <th style="width: 35%;">
                                                <i class="fas fa-cog me-1"></i>
                                                Nama Komponen
                                            </th>
                                            <th style="width: 15%;" class="text-center">
                                                <i class="fas fa-chart-bar me-1"></i>
                                                Status
                                            </th>
                                            <th style="width: 45%;">
                                                <i class="fas fa-comment me-1"></i>
                                                Komentar
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($inspeksi->komponens as $index => $komponen)
                                            <tr class="{{ $komponen->pivot->status == 'NO' ? 'table-warning' : '' }}">
                                                <td class="text-center fw-bold text-muted">
                                                    {{ $index + 1 }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="bg-{{ $komponen->pivot->status == 'OK' ? 'success' : 'danger' }} rounded-circle d-flex align-items-center justify-content-center"
                                                                 style="width: 35px; height: 35px;">
                                                                <i class="fas fa-{{ $komponen->pivot->status == 'OK' ? 'check' : 'times' }} text-white"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="fw-semibold">{{ $komponen->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-{{ $komponen->pivot->status == 'OK' ? 'success' : 'danger' }} px-3 py-2">
                                                        <i class="fas fa-{{ $komponen->pivot->status == 'OK' ? 'check-circle' : 'times-circle' }} me-1"></i>
                                                        {{ $komponen->pivot->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($komponen->pivot->komentar)
                                                        <div class="bg-light rounded p-2 border-start border-{{ $komponen->pivot->status == 'OK' ? 'success' : 'danger' }} border-3">
                                                            <i class="fas fa-quote-left text-muted me-2"></i>
                                                            {{ $komponen->pivot->komentar }}
                                                        </div>
                                                    @else
                                                        <span class="text-muted fst-italic">
                                                            <i class="fas fa-minus me-1"></i>
                                                            Tidak ada komentar
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                                    <p class="mb-0">Tidak ada data komponen</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Total {{ $inspeksi->komponens->count() }} komponen telah diinspeksi
                                    </small>
                                </div>
                                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                                    <div class="d-flex justify-content-md-end justify-content-start gap-2">
                                        <a href="{{ route('supervisor.inspeksi.index') }}"
                                           class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-list me-1"></i>
                                            Lihat Semua Inspeksi
                                        </a>
                                        <a href="{{ route('supervisor.inspeksi.exportPdf', $inspeksi->id) }}"
                                           class="btn btn-danger btn-sm">
                                            <i class="fas fa-download me-1"></i>
                                            Unduh PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
