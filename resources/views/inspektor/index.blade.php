@extends('layout.template')
@section('title','Home - Inspeksi')
@section('content')
        <div class="container-fluid mt-4">
    <h4 class="mb-4">Dashboard Inspektor</h4>

    {{-- Ringkasan Cepat --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Inspeksi</h5>
                    <p class="card-text fs-4">{{ $totalInspeksi }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-dark bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <p class="card-text fs-4">{{ $pending }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Approved</h5>
                    <p class="card-text fs-4">{{ $approved }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Cancel</h5>
                    <p class="card-text fs-4">{{ $cancel }}</p>
                </div>
            </div>
        </div>
    </div>
    {{-- Shortcut Aksi --}}
    <div class="mb-4">
        <a href="{{ route('inspeksi.create') }}" class="btn btn-outline-primary me-2">
            <i class="fa fa-plus"></i> Mulai Inspeksi Baru
        </a>
    </div>
    {{--  --}}
    <form method="GET" action="{{ route('inspektor.index') }}" class="mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
            <label>Tanggal Sampai</label>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-2">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="">-- Semua --</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Cancel" {{ request('status') == 'Cancel' ? 'selected' : '' }}>Cancel</option>
            </select>
        </div>
        <div class="col-md-2">
            <label>Serial Number</label>
            <input type="text" name="serial_number" class="form-control" placeholder="Contoh: LG936L/SDLG" value="{{ request('serial_number') }}">
        </div>
        <div class="col-md-2">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-primary w-100"><i class="fa fa-filter"></i> Filter</button>
        </div>
    </div>
</form>
@if($filteredInspeksi->count())
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Alat Berat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filteredInspeksi as $inspeksi)
                    <tr>
                        <td>{{ $inspeksi->created_at->format('d M Y') }}</td>
                        <td>{{ $inspeksi->alatBerat->merk }} ({{ $inspeksi->alatBerat->serial_number }})</td>
                            <td>
                            @php
                                $badgeColor = match(strtolower($inspeksi->status)) {
                                    'pending' => 'bg-warning text-dark',
                                    'approved' => 'bg-success',
                                    'cancel' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $badgeColor }}">{{ $inspeksi->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('inspeksi.detail', $inspeksi->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $filteredInspeksi->links() }}
    </div>
@else
    <p class="text-muted">Tidak ada data inspeksi ditemukan.</p>
@endif



</div>
@endsection

