<div class="container-fluid pt-4 px-4"></div>

<div class="col-sm-12 col-xl-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Edit Users</h6>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" wire:model="name" value=" {{ @old('name') }}" id="name"
                    aria-describedby="emailHelp">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" wire:model="email" value=" {{ @old('email') }}" id="email"
                    aria-describedby="emailHelp">
                    @error('email')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" wire:model="password" value=" {{ @old('password') }}" id="password">
                @error('password')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="role" class="form-select" wire:model="role">
                    <option value="">---Pilih---</option>
                    <option value="inspector">Inspector</option>
                    <option value="supervisor">Supervisor</option>
                </select>
                @error('role')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">foto Users</label>
                <input type="file" class="form-control" wire:model="foto" value=" {{ @old('foto') }}" id="email"
                    aria-describedby="emailHelp">
                    @error('foto')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="button" wire:click="update" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
</div>
</div>
