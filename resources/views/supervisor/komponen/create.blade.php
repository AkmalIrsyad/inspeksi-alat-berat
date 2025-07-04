<div class="container-fluid pt-4 px-4"></div>

<div class="col-sm-12 col-xl-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Add Komponen</h6>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Komponen</label>
                <input type="text" class="form-control" wire:model="name" value=" {{ @old('name') }}" id="name"
                    aria-describedby="emailHelp">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="button" wire:click="store" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
</div>
</div>

