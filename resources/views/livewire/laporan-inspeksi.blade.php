<div>
    <h2 class="text-xl font-bold mb-4">Laporan Inspeksi</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div>
            <label>Tanggal Mulai</label>
            <input type="date" wire:model="tanggalMulai" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Tanggal Akhir</label>
            <input type="date" wire:model="tanggalAkhir" class="w-full border rounded p-2">
        </div>
        <div>
            <label>Status</label>
            <select wire:model="status" class="w-full border rounded p-2">
                <option value="">-- Semua --</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Cancel">Cancel</option>
            </select>
        </div>
        <div>
            <label>Alat Berat</label>
            <select wire:model="alatBeratId" class="w-full border rounded p-2">
                <option value="">-- Semua --</option>
                @foreach($alatBerats as $alat)
                    <option value="{{ $alat->id }}">{{ $alat->merk }} ({{ $alat->serial_number }})</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Alat Berat</th>
                <th class="border p-2">User</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inspeksis as $item)
                <tr>
                    <td class="border p-2">{{ $item->created_at->format('d-m-Y') }}</td>
                    <td class="border p-2">{{ $item->alatBerat->merk ?? '-' }}</td>
                    <td class="border p-2">{{ $item->user->name ?? '-' }}</td>
                    <td class="border p-2">{{ $item->status }}</td>
                    <td class="border p-2 space-x-2">
                        <a href="{{ route('supervisor.inspeksi.detail', $item->id) }}" class="text-blue-500 underline">Detail</a>
                        <a href="{{ route('supervisor.inspeksi.export', $item->id) }}" class="text-green-600 underline" target="_blank">PDF</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border p-2 text-center">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
>
