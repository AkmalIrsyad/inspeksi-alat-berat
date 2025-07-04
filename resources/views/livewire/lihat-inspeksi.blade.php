<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Detail Inspeksi</h2>

    <div class="mb-4">
        <p><strong>Alat Berat:</strong> {{ $inspeksi->alatBerat->merk }} ({{ $inspeksi->alatBerat->serial_number }})</p>
        <p><strong>Tanggal:</strong> {{ $inspeksi->created_at->format('d M Y H:i') }}</p>
        <p><strong>Status Umum:</strong> {{ $inspeksi->status }}</p>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Komponen</th>
                    <th class="px-4 py-2 text-center">Status</th>
                    <th class="px-4 py-2">Komentar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inspeksi->komponens as $komponen)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $komponen->name }}</td>
                        <td class="px-4 py-2 text-center">{{ $komponen->pivot->status }}</td>
                        <td class="px-4 py-2">{{ $komponen->pivot->komentar }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

