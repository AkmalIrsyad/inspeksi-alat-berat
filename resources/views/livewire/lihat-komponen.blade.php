<div class="container-fluid pt-4 px-4">
    <div class="row">
    @foreach ($komponen as $serial => $listKomponen)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    Serial Number: {{ $serial }}
                </div>
                <div class="card-body">
                    <h5>Jumlah Komponen: {{ $listKomponen->count() }}</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($listKomponen as $data)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>🔧 {{ $data->name }}</span>
                                    <button class="btn btn-sm btn-danger" wire:click="destroy({{ $data->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>

