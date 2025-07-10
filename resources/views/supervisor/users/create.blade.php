{{-- BACKDROP MANUAL --}}
<div class="modal-backdrop fade show"></div>

<div class="modal show d-block" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah User</h5>
        <button type="button" class="btn-close" wire:click="$set('addPage', false)"></button>
      </div>
      <div class="modal-body">
        {{-- NAMA --}}
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" wire:model.defer="name">
          @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" wire:model.defer="email">
          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" wire:model.defer="password">
          @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- ROLE --}}
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select class="form-select" wire:model.defer="role">
            <option value="">-- Pilih Role --</option>
            <option value="inspector">inspector</option>
            <option value="supervisor">Supervisor</option>
          </select>
          @error('role') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- FOTO --}}
        <div class="mb-3">
          <label for="foto" class="form-label">Foto</label>
          <input type="file" class="form-control" wire:model="foto">
          @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="$set('addPage', false)">Batal</button>
        <button type="button" class="btn btn-primary" wire:click="store">Simpan</button>
      </div>
    </div>
  </div>
</div>
