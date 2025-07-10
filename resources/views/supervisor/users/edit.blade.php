{{-- BACKDROP MANUAL --}}
<div class="modal-backdrop fade show"></div>

<div class="modal show d-block" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" wire:click="$set('editPage', false)" aria-label="Close"></button>
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

        {{-- ROLE --}}
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select class="form-select" wire:model.defer="role">
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="supervisor">Supervisor</option>
            <option value="inspektor">Inspektor</option>
          </select>
          @error('role') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- FOTO --}}
        <div class="mb-3">
          <label for="foto" class="form-label">Foto Baru (Opsional)</label>
          <input type="file" class="form-control" wire:model="foto">
          @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        @if ($foto)
            <div class="mb-3">
                <label class="form-label">Preview Foto Baru:</label><br>
                <img src="{{ $foto->temporaryUrl() }}" class="img-thumbnail" style="max-height: 150px;">
            </div>
        @endif
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="$set('editPage', false)">Batal</button>
        <button type="button" class="btn btn-primary" wire:click="update">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>
