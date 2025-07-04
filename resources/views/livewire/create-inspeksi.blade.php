{{-- Alert Success --}}
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tools me-2"></i>
                        Form Inspeksi Alat Berat
                    </h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        {{-- Pilih Alat Berat --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="alatBerat" class="form-label fw-bold">
                                    <i class="fas fa-excavator me-1"></i>
                                    Pilih Alat Berat
                                </label>
                                <select wire:model.lazy="alatBeratId"
                                        id="alatBerat"
                                        class="form-select form-select-lg">
                                    <option value="">-- Pilih Alat Berat --</option>
                                    @foreach($alatBerats as $alat)
                                        <option value="{{ $alat->id }}">
                                            {{ $alat->merk }} ({{ $alat->serial_number }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Tabel Komponen --}}
                        @if ($alatBeratId)
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-list-check me-2 text-primary"></i>
                                <h6 class="mb-0 fw-bold">Status Komponen Alat Berat</h6>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width: 30%;">
                                                <i class="fas fa-cog me-1"></i>
                                                Komponen
                                            </th>
                                            <th class="text-center" style="width: 15%;">
                                                <i class="fas fa-check-circle me-1 text-success"></i>
                                                OK
                                            </th>
                                            <th class="text-center" style="width: 15%;">
                                                <i class="fas fa-times-circle me-1 text-danger"></i>
                                                NO
                                            </th>
                                            <th style="width: 40%;">
                                                <i class="fas fa-comment me-1"></i>
                                                Komentar
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($komponens as $index => $komponen)
                                            <tr class="{{ $index % 2 == 0 ? 'table-light' : '' }}">
                                                <td class="fw-semibold">
                                                    <span class="badge bg-secondary me-2">{{ $index + 1 }}</span>
                                                    {{ $komponen->name }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input form-check-input-lg"
                                                               type="radio"
                                                               wire:model="selectedKomponen.{{ $komponen->id }}.status"
                                                               value="OK"
                                                               id="ok-{{ $komponen->id }}">
                                                        <label class="form-check-label text-success fw-bold"
                                                               for="ok-{{ $komponen->id }}">
                                                            OK
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input form-check-input-lg"
                                                               type="radio"
                                                               wire:model="selectedKomponen.{{ $komponen->id }}.status"
                                                               value="NO"
                                                               id="no-{{ $komponen->id }}">
                                                        <label class="form-check-label text-danger fw-bold"
                                                               for="no-{{ $komponen->id }}">
                                                            NO
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-edit text-muted"></i>
                                                        </span>
                                                        <textarea wire:model.defer="selectedKomponen.{{ $komponen->id }}.komentar"
                                                                  class="form-control"
                                                                  rows="2"
                                                                  placeholder="Tambahkan komentar atau catatan..."></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted">
                                        <small>
                                            <i class="fas fa-info-circle me-1"></i>
                                            Pastikan semua komponen telah dipilih statusnya
                                        </small>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-secondary me-2">
                                            <i class="fas fa-times me-1"></i>
                                            Batal
                                        </button>
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="fas fa-save me-1"></i>
                                            Simpan Inspeksi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
