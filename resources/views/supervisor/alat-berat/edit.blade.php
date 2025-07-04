<div class="container-fluid pt-4 px-4"></div>

<div class="col-sm-12 col-xl-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Edit Alat Berat</h6>
        <form>
            <div class="mb-3">
                <label for="merk" class="form-label">Merk</label>
                <input type="text" class="form-control" wire:model="merk" value=" {{ @old('merk') }}" id="name"
                    aria-describedby="emailHelp">
                @error('merk')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="serial_number" class="form-label">Serial Number</label>
                <input type="text" class="form-control" wire:model="serial_number" value=" {{ @old('serial_number') }}" id="email"
                    aria-describedby="emailHelp">
                    @error('serial_number')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">jenis alat berat</label>
                <select id="jenis" class="form-select" wire:model="jenis">
                    <option value="">---Pilih---</option>
                    <option value="Excavator">Excavator</option>
                    <option value="Bulldozer">Bulldozer</option>
                    <option value="Crane">Crane</option>
                    <option value="Wheel Loader">Wheel Loader</option>
                    <option value="Forklift">Forklift</option>
                    <option value="Grader">Grader</option>
                    <option value="Dump Truck">Dump Truck</option>
                    <option value="Paver">Paver</option>
                    <option value="Roller Compactor">Roller Compactor</option>
                </select>
                @error('jenis')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">foto alat berat</label>
                <input type="file" class="form-control" wire:model="foto" value=" {{ @old('foto') }}" id="email"
                    aria-describedby="emailHelp">
                    @error('foto')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="button" wire:click="update()" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
</div>
</div>
