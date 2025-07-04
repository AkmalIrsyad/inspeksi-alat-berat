<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <h6 class="mb-4">Data Users</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Jenis</th>
                            <th>
                                Foto
                            </th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alatBerat as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration}}</th>
                            <td>{{ $data->merk }}</td>
                            <td>{{ $data->serial_number }}</td>
                            <td>{{ $data->jenis }}</td>
                            <td>
                                <img src="{{ asset('storage/alatberat/' . $data->foto) }}" alt="{{ $data->merk }}" style="width:150px">
                            </td>

                            <td>
                                <button class="btn btn-info" wire:click="edit({{ $data->id }})" >Edit</button>
                                <button class="btn btn-danger" wire:click="destroy({{ $data->id }})">Delete</button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5">Data Alat Berat Belum Ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $alatBerat->links() }}
                <button wire:click="create" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
    @if ($addPage)
    @include('supervisor.alat-berat.create')
    @endif
    @if ($editPage)
        @include('supervisor.alat-berat.edit')
    @endif
    </div>
