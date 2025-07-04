<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="text-primary mb-1">
                        <i class="fas fa-history me-2"></i>
                        Riwayat Inspeksi Saya
                    </h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-info-circle me-1"></i>
                        Berikut adalah daftar semua inspeksi yang telah Anda lakukan
                    </p>
                </div>
                <div>
                    <button class="btn btn-outline-primary" onclick="window.location.reload()">
                        <i class="fas fa-sync-alt me-1"></i>
                        Refresh
                    </button>
                </div>
            </div>

            {{-- Statistics Cards --}}
            @php
                $totalInspeksi = $inspeksis->count();
                $statusOK = $inspeksis->where('status', 'OK')->count();
                $statusNO = $inspeksis->where('status', 'NO')->count();
                $inspeksiHariIni = $inspeksis->where('created_at', '>=', today())->count();
            @endphp

            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-white-50 mb-1">Total Inspeksi</h6>
                                    <h3 class="mb-0">{{ $totalInspeksi }}</h3>
                                </div>
                                <div class="text-white-50">
                                    <i class="fas fa-clipboard-list fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-white-50 mb-1">Status OK</h6>
                                    <h3 class="mb-0">{{ $statusOK }}</h3>
                                </div>
                                <div class="text-white-50">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-white-50 mb-1">Perlu Perhatian</h6>
                                    <h3 class="mb-0">{{ $statusNO }}</h3>
                                </div>
                                <div class="text-white-50">
                                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-white-50 mb-1">Hari Ini</h6>
                                    <h3 class="mb-0">{{ $inspeksiHariIni }}</h3>
                                </div>
                                <div class="text-white-50">
                                    <i class="fas fa-calendar-day fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table Section --}}
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-table me-2"></i>
                            Daftar Riwayat Inspeksi
                        </h5>
                        <span class="badge bg-light text-dark">
                            {{ $totalInspeksi }} Inspeksi
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($inspeksis->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th scope="col" style="width: 5%;" class="text-center">#</th>
                                        <th scope="col" style="width: 20%;">
                                            <i class="fas fa-calendar me-1"></i>
                                            Tanggal & Waktu
                                        </th>
                                        <th scope="col" style="width: 35%;">
                                            <i class="fas fa-excavator me-1"></i>
                                            Alat Berat
                                        </th>
                                        <th scope="col" style="width: 20%;" class="text-center">
                                            <i class="fas fa-chart-line me-1"></i>
                                            Status
                                        </th>
                                        <th scope="col" style="width: 20%;" class="text-center">
                                            <i class="fas fa-cogs me-1"></i>
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inspeksis as $index => $inspeksi)
                                        <tr class="{{ $inspeksi->status == 'NO' ? 'table-warning' : '' }}">
                                            <td class="text-center fw-bold text-muted">
                                                {{ $index + 1 }}
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="fw-semibold">
                                                        <i class="fas fa-calendar-alt me-1 text-primary"></i>
                                                        {{ $inspeksi->created_at->format('d M Y') }}
                                                    </div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ $inspeksi->created_at->format('H:i') }} WIB
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                             style="width: 40px; height: 40px;">
                                                            <i class="fas fa-truck text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-semibold">
                                                            {{ $inspeksi->alatBerat->merk ?? '-' }}
                                                        </div>
                                                        @if($inspeksi->alatBerat->serial_number)
                                                            <small class="text-muted">
                                                                SN: {{ $inspeksi->alatBerat->serial_number }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($inspeksi->status == 'OK')
                                                    <span class="badge bg-success px-3 py-2">
                                                        <i class="fas fa-check-circle me-1"></i>
                                                        OK
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning px-3 py-2">
                                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                                        {{ $inspeksi->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('inspeksi.detail', $inspeksi->id) }}"
                                                       class="btn btn-outline-primary btn-sm"
                                                       data-bs-toggle="tooltip"
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye me-1"></i>
                                                        Detail
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-outline-secondary btn-sm dropdown-toggle dropdown-toggle-split"
                                                            data-bs-toggle="dropdown">
                                                        <span class="visually-hidden">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('inspeksi.detail', $inspeksi->id) }}">
                                                                <i class="fas fa-eye me-2"></i>Lihat Detail
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fas fa-file-pdf me-2"></i>Export PDF
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item text-muted" href="#">
                                                                <i class="fas fa-share me-2"></i>Bagikan
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{-- Empty State --}}
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-clipboard-list text-muted" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="text-muted mb-2">Belum Ada Riwayat Inspeksi</h5>
                            <p class="text-muted mb-4">
                                Anda belum melakukan inspeksi apapun. Mulai inspeksi pertama Anda sekarang!
                            </p>
                            <a href="{{ route('inspeksi.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>
                                Buat Inspeksi Baru
                            </a>
                        </div>
                    @endif
                </div>
                @if($inspeksis->count() > 0)
                <div class="card-footer bg-light">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Menampilkan {{ $inspeksis->count() }} dari {{ $totalInspeksi }} total inspeksi
                            </small>
                        </div>
                        <div class="col-md-6 text-md-end mt-2 mt-md-0">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-filter me-1"></i>
                                    Filter
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-sort me-1"></i>
                                    Urutkan
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-download me-1"></i>
                                    Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Initialize Tooltips --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
