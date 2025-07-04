<!-- Form for Editing (edit.blade.php) -->
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Inspeksi</h5>
        <button type="button" class="btn-close" wire:click="$set('editPage', false)" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="save">
            <div class="form-group">
                <label for="komponens">Komponen</label>
                <input type="text" class="form-control" id="komponens" wire:model="komponens">
            </div>
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="text" class="form-control" id="user_id" wire:model="user_id">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" wire:model="status">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
