<div class="container-fluid pt-4 px-4">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Add Komponen</h6>

            <form wire:submit.prevent="store">
                @foreach ($komponens as $index => $komponen)
                    <div class="mb-3 d-flex align-items-center gap-2">
                        <input type="text"
                               class="form-control"
                               placeholder="Nama Komponen"
                               wire:model="komponens.{{ $index }}.name">
                        @if(count($komponens) > 1)
                            <button type="button" class="btn btn-danger btn-sm" wire:click="removeField({{ $index }})">Hapus</button>
                        @endif
                    </div>
                    @error('komponens.'.$index.'.name')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                @endforeach

                <button type="button" wire:click="addField" class="btn btn-secondary btn-sm mb-3">+ Tambah Komponen</button>
                <br>
                <button type="submit" class="btn btn-primary">Simpan Semua</button>
            </form>
        </div>
    </div>
</div>
