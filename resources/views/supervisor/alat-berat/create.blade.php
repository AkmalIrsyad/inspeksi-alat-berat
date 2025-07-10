<!-- Backdrop -->
<div class="modal-backdrop fade show"></div>

<!-- Modal -->
<div class="modal show d-block" tabindex="-1" role="dialog" style="z-index: 1055;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Alat Berat</h5>
                <button type="button" class="btn-close" wire:click="$set('addPage', false)"></button>
            </div>
            <div class="modal-body">
                <form>
                    {{-- Merk --}}
                    <div class="mb-3">
                        <label class="form-label">Merk</label>
                        <input type="text" class="form-control" wire:model="merk">
                        @error('merk') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Serial Number --}}
                    <div class="mb-3">
                        <label class="form-label">Serial Number</label>
                        <input type="text" class="form-control" wire:model="serial_number">
                        @error('serial_number') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Jenis --}}
                    <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select class="form-select" wire:model="jenis">
                            <option value="">---Pilih---</option>
                            @foreach(['Excavator','Bulldozer','Crane','Wheel Loader','Forklift','Grader','Dump Truck','Paver','Roller Compactor'] as $j)
                                <option value="{{ $j }}">{{ $j }}</option>
                            @endforeach
                        </select>
                        @error('jenis') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Foto --}}
                    <div class="mb-3">
                        <label class="form-label">Foto Alat Berat</label>
                        <input type="file" class="form-control" wire:model="foto">
                        @error('foto') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="$set('addPage', false)">Batal</button>
                <button type="button" class="btn btn-primary" wire:click="store">Simpan</button>
            </div>
        </div>
    </div>
</div>
