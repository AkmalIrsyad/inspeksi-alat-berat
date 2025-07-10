<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">

                {{-- Flash Message --}}
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <h6 class="mb-0">Data Alat Berat</h6>
                    <button wire:click="create" class="btn btn-primary mt-2 mt-md-0">Tambah</button>
                </div>

                {{-- Tabel Responsif --}}
                <div class="table-responsive">
                    <table class="table align-middle table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Merk</th>
                                <th>Serial Number</th>
                                <th>Jenis</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alatBerat as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->merk }}</td>
                                    <td>{{ $data->serial_number }}</td>
                                    <td>{{ $data->jenis }}</td>
                                    <td>
                                        <img src="{{ asset('storage/alatberat/' . $data->foto) }}"
                                             alt="{{ $data->merk }}"
                                             style="max-width: 120px; height: auto;" class="img-fluid rounded">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <button class="btn btn-info btn-sm"
                                                    wire:click="edit({{ $data->id }})">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                    wire:click="destroy({{ $data->id }})">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Data Alat Berat Belum Ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $alatBerat->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    @if ($addPage)
        @include('supervisor.alat-berat.create')
    @endif

    {{-- Modal Edit --}}
    @if ($editPage)
        @include('supervisor.alat-berat.edit')
    @endif
</div>
