<div>
    <div class="mb-3">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Cari alat berat atau user..." class="form-control">
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Tanggal</th>
                <th>Alat Berat</th>
                <th>User</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inspeksis as $inspeksi)
                <tr>
                    <td>{{ $inspeksi->created_at->format('d M Y') }}</td>
                    <td>{{ $inspeksi->alatBerat->merk }} ({{ $inspeksi->alatBerat->serial_number }})</td>
                    <td>{{ $inspeksi->user->name }}</td>
                    <td>{{ $inspeksi->status }}</td>
                    <td>
                        <a href="{{ route('inspeksi.detail', $inspeksi->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $inspeksis->links() }}
</div>

