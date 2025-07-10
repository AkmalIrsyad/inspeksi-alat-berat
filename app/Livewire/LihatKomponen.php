<?php

namespace App\Livewire;

use App\Models\Komponen;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\On;

class LihatKomponen extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $selected = [];

    #[On('lihat-komponen')]
    public function resetSelection()
    {
        $this->selected = [];
    }

    public function render()
    {
        $komponen = Komponen::with('alatBerat')->get()->groupBy(function ($item) {
            return $item->alatBerat?->serial_number ?? 'Serial Number Tidak Diketahui';
        });

        return view('livewire.lihat-komponen', compact('komponen'));
    }

    public function destroy($id)
    {
        Komponen::find($id)?->delete();
        session()->flash('success', 'Komponen berhasil dihapus.');
    }

    public function deleteSelected()
    {
        Komponen::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        session()->flash('success', 'Komponen terpilih berhasil dihapus.');
    }

    public function toggleAll($serial)
    {
        $komponen = Komponen::with('alatBerat')->get()->groupBy(function ($item) {
            return $item->alatBerat?->serial_number ?? 'Serial Number Tidak Diketahui';
        });

        $ids = $komponen[$serial]->pluck('id')->toArray();
        $alreadySelected = collect($this->selected)->intersect($ids)->count() === count($ids);

        if ($alreadySelected) {
            $this->selected = array_values(array_diff($this->selected, $ids));
        } else {
            $this->selected = array_values(array_unique(array_merge($this->selected, $ids)));
        }
    }
}
