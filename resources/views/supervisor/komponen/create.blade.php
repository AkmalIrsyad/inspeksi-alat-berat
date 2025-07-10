<!-- Backdrop -->
<div class="modal-backdrop fade show"></div>

<!-- Modal -->
<div class="modal show d-block" tabindex="-1" role="dialog" style="z-index: 1055;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="store">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Komponen</h5>
                    <button type="button" class="btn-close" wire:click="$set('addPage', false)"></button>
                </div>

                <div class="modal-body">
                    {{-- Error Global (jika diperlukan) --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @foreach ($komponens as $index => $komponen)
                        <div class="mb-3 d-flex align-items-start gap-2">
                            <input type="text"
                                   class="form-control @error('komponens.'.$index.'.name') is-invalid @enderror"
                                   placeholder="Nama Komponen"
                                   wire:model="komponens.{{ $index }}.name">
                            @if(count($komponens) > 1)
                                <button type="button" class="btn btn-danger btn-sm" wire:click="removeField({{ $index }})">Hapus</button>
                            @endif
                        </div>
                        @error('komponens.'.$index.'.name')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror
                    @endforeach

                    <button type="button" wire:click="addField" class="btn btn-secondary btn-sm mt-2">+ Tambah Komponen</button>
                </div>

                <div class="modal-footer">
                    <button type="button" wire:click="$set('addPage', false)" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>
