<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="container mt-4">
                    <div class="row">
                        @foreach($alatBerat as $data)
                            <div class="col-md-4 mb-4 d-flex">
                                <div class="card flex-fill">
                                    <img src="{{ asset('storage/alatberat/' . $data->foto) }}" class="card-img-top object-fit-cover" alt="Foto Alat Berat" style="height: 200px; width: 100%;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $data->merk }}</h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"> Serial Number : <span class="badge bg-info">{{ $data->serial_number }}</span></li>
                                        <li class="list-group-item"> Jenis Alat : <span class="badge bg-info">{{ $data->jenis }}</li>
                                    </ul>
                                    <div class="card-body">
                                        <button wire:click="create({{ $data->id }})" class="btn btn-outline-success card-link">Tambah Komponen</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- {{ $alatBerat->links() }} --}}
            </div>
        </div>
    </div>
    @if ($addPage)
    @include('supervisor.komponen.create')
    @endif
    @if ($editPage)
        @include('supervisor.komponen.edit')
    @endif
    </div>
