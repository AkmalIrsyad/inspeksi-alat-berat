@extends('layout.template')
@section('title','Dashboard - Supervisor')
@section('content')

<div class="container-fluid pt-4 px-4">

    {{-- Statistik Ringkasan --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-wrench fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Inspeksi</p>
                    <h6 class="mb-0">{{ $data['jmlInspeksi'] }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-tractor fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Alat Berat</p>
                    <h6 class="mb-0">{{ $data['jmlAlatberat'] }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Users</p>
                    <h6 class="mb-0">{{ $data['jmlAnggota'] }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-warning">
                <i class="fas fa-clock fa-3x text-warning"></i>
                <div class="ms-3">
                    <p class="mb-2">Pending</p>
                    <h6 class="mb-0">{{ $statusData['Pending'] }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-success">
                <i class="fas fa-thumbs-up fa-3x text-success"></i>
                <div class="ms-3">
                    <p class="mb-2">Approved</p>
                    <h6 class="mb-0">{{ $statusData['Approved'] }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-danger">
                <i class="fas fa-window-close fa-3x text-danger"></i>
                <div class="ms-3">
                    <p class="mb-2">Cancel</p>
                    <h6 class="mb-0">{{ $statusData['Cancel'] }}</h6>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Inspeksi --}}
    <div class="card mb-4">
        <div class="card-header bg-light fw-bold">🔍 Filter Inspeksi</div>
        <div class="card-body">
            <form method="GET" action="{{ route('supervisor.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Mulai Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Cancel" {{ request('status') == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Serial Number</label>
                    <input type="text" name="serial" value="{{ request('serial') }}" class="form-control" placeholder="Contoh: LG936L/SDLG">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Hasil Filter --}}
    @if($filteredInspeksi->count())
    <div class="card">
        <div class="card-header bg-light fw-bold">📋 Hasil Inspeksi</div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Alat Berat</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($filteredInspeksi as $inspeksi)
                    <tr>
                        <td>{{ $inspeksi->created_at->format('d M Y') }}</td>
                        <td>{{ $inspeksi->alatBerat->merk }} ({{ $inspeksi->alatBerat->serial_number }})</td>
                        <td>
                            <span class="badge
                                @if($inspeksi->status == 'Pending') bg-warning
                                @elseif($inspeksi->status == 'Approved') bg-success
                                @else bg-danger
                                @endif">
                                {{ $inspeksi->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('supervisor.inspeksi.detail', $inspeksi->id) }}" class="btn btn-sm btn-outline-primary">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $filteredInspeksi->withQueryString()->links() }}
        </div>
    </div>
    @endif

</div> {{-- End Container --}}

@endsection
