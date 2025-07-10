@extends('layout.template')
@section('title','komponen - walk around inspection')
@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Inspeksi</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Alat Berat</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inspeksis as $inspeksi)
                <tr>
                    <td>{{ $inspeksi->user->name }}</td>
                    <td>{{ $inspeksi->alatBerat->merk }} ({{ $inspeksi->alatBerat->serial_number }})</td>
                    <td>
                        <span class="badge
                            {{ $inspeksi->status == 'Approved' ? 'bg-success' :
                               ($inspeksi->status == 'Cancel' ? 'bg-danger' : 'bg-warning') }}">
                            {{ $inspeksi->status }}
                        </span>
                    </td>
                    <td>{{ $inspeksi->created_at->format('d M Y') }}</td>
                    <td>
                        @if($inspeksi->status == 'Pending')
                            <form action="{{ route('supervisor.inspeksi.approve', $inspeksi->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm" onclick="return confirm('Yakin setujui?')">Setujui</button>
                            </form>
                            <form action="{{ route('supervisor.inspeksi.cancel', $inspeksi->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-warning btn-sm" onclick="return confirm('Yakin batalkan?')">Batalkan</button>
                            </form>
                        @endif
                        <form action="{{ route('supervisor.inspeksi.destroy', $inspeksi->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus inspeksi ini?')">Hapus</button>
                            </form>
                    </td>
                    <td>
                    <a href="{{ route('supervisor.inspeksi.detail', $inspeksi->id) }}" class="btn btn-primary btn-sm">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

