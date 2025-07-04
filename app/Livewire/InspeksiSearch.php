<?php

namespace App\Livewire;

use App\Models\Inspeksi;
use Livewire\Component;
use Livewire\WithPagination;

class InspeksiSearch extends Component
{
    use WithPagination;


    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman pertama saat search berubah
    }

    public function render()
    {
        $inspeksis = Inspeksi::with(['alatBerat', 'user'])
            ->whereHas('alatBerat', function ($query) {
                $query->where('merk', 'like', '%'.$this->search.'%')
                      ->orWhere('serial_number', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('user', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.inspeksi-search',compact('inspeksis'));
    }
}
