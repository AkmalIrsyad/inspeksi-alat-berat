<div class="container-fluid">
    <div class="row justify-content-center">
            {{-- Alert Success --}}
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
        <div class="col-lg-12 col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-edit me-2"></i>
                        Edit Profile
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form wire:submit.prevent="updateProfile" enctype="multipart/form-data">
                        {{-- Informasi Dasar --}}
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Informasi Dasar
                                </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="fas fa-user me-1"></i>
                                    Nama Lengkap
                                </label>
                                <input type="text"
                                       wire:model.defer="name"
                                       id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Masukkan nama lengkap">
                                @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-1"></i>
                                    Email
                                </label>
                                <input type="email"
                                       wire:model.defer="email"
                                       id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Masukkan alamat email">
                                @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Foto Profil --}}
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-camera me-1"></i>
                                    Foto Profil
                                </label>

                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center">
                                            @if ($foto)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ $foto->temporaryUrl() }}"
                                                         class="img-thumbnail rounded-circle shadow-sm"
                                                         width="120" height="120"
                                                         style="object-fit: cover;"
                                                         alt="Preview Foto">
                                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-success">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Preview foto baru
                                                    </small>
                                                </div>
                                            @elseif (auth()->user()->foto)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ asset('storage/users/' . auth()->user()->foto) }}"
                                                         class="img-thumbnail rounded-circle shadow-sm"
                                                         width="120" height="120"
                                                         style="object-fit: cover;"
                                                         alt="Foto Profil Saat Ini">
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-muted">
                                                        <i class="fas fa-image me-1"></i>
                                                        Foto saat ini
                                                    </small>
                                                </div>
                                            @else
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm"
                                                     style="width: 120px; height: 120px;">
                                                    <i class="fas fa-user text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Belum ada foto
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <input type="file"
                                                   wire:model="foto"
                                                   id="foto"
                                                   class="form-control @error('foto') is-invalid @enderror"
                                                   accept="image/*">
                                            @error('foto')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="text-muted">
                                            <small>
                                                <i class="fas fa-info-circle me-1"></i>
                                                Format: JPG, PNG, GIF. Maksimal 2MB
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <hr class="my-4">

                        {{-- Keamanan Password --}}
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-lock me-1"></i>
                                    Keamanan Password
                                </h6>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Catatan:</strong> Kosongkan bagian password jika tidak ingin mengubah password.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="old_password" class="form-label fw-semibold">
                                    <i class="fas fa-key me-1"></i>
                                    Password Lama
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-unlock-alt text-muted"></i>
                                    </span>
                                    <input type="password"
                                           wire:model.defer="old_password"
                                           id="old_password"
                                           class="form-control @error('old_password') is-invalid @enderror"
                                           placeholder="Password saat ini">
                                </div>
                                @error('old_password')
                                <div class="text-danger mt-1">
                                    <small>
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-1"></i>
                                    Password Baru
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password"
                                           wire:model.defer="password"
                                           id="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Password baru">
                                </div>
                                @error('password')
                                <div class="text-danger mt-1">
                                    <small>
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="fas fa-check-double me-1"></i>
                                    Konfirmasi Password
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-check text-muted"></i>
                                    </span>
                                    <input type="password"
                                           wire:model.defer="password_confirmation"
                                           id="password_confirmation"
                                           class="form-control"
                                           placeholder="Ulangi password baru">
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted">
                                        <small>
                                            <i class="fas fa-shield-alt me-1"></i>
                                            Data Anda akan disimpan dengan aman
                                        </small>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-secondary me-2">
                                            <i class="fas fa-times me-1"></i>
                                            Batal
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <span wire:loading.remove wire:target="updateProfile">
                                                <i class="fas fa-save me-1"></i>
                                                Simpan Perubahan
                                            </span>
                                            <span wire:loading wire:target="updateProfile">
                                                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                                Menyimpan...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
