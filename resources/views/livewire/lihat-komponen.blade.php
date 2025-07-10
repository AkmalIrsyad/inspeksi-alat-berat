<div class="container-fluid pt-4 px-4">
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="accordion" id="accordionKomponen">
        @foreach ($komponen as $serial => $listKomponen)
            @php
                $serialSlug = \Illuminate\Support\Str::slug($serial);
                $ids = $listKomponen->pluck('id')->toArray();
                $allSelected = collect($selected)->intersect($ids)->count() === count($ids);
            @endphp

            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-{{ $serialSlug }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $serialSlug }}" aria-expanded="false"
                        aria-controls="collapse-{{ $serialSlug }}">
                        Serial Number: <strong class="ms-2">{{ $serial }}</strong>
                    </button>
                </h2>

                <div id="collapse-{{ $serialSlug }}" class="accordion-collapse collapse"
                    aria-labelledby="heading-{{ $serialSlug }}" data-bs-parent="#accordionKomponen">
                    <div class="accordion-body">

                        <button wire:click="toggleAll('{{ $serial }}')" class="btn btn-sm btn-outline-primary mb-2">
                            {{ $allSelected ? 'Uncheck Semua' : 'Pilih Semua' }}
                        </button>

                        <table class="table table-sm table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th><input type="checkbox" wire:click="toggleAll('{{ $serial }}')" {{ $allSelected ? 'checked' : '' }}></th>
                                    <th>No</th>
                                    <th>Nama Komponen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listKomponen as $index => $data)
                                    <tr>
                                        <td>
                                            <input type="checkbox" wire:model="selected" value="{{ $data->id }}">
                                        </td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <button wire:click="destroy({{ $data->id }})"
                                                    class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada komponen</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if (count($selected))
        <div class="mt-3">
            <button wire:click="deleteSelected" class="btn btn-danger">
                Hapus Terpilih ({{ count($selected) }})
            </button>
        </div>
    @endif
</div>
