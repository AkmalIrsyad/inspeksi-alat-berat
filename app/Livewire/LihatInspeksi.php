<?php
namespace App\Livewire;

use App\Models\Inspeksi;
use Livewire\Component;

class LihatInspeksi extends Component
{
    public $id;
    public $inspeksi;

    public function mount($id)
    {
        $this->id = $id;
        $this->inspeksi = Inspeksi::with(['alatBerat', 'komponens'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.lihat-inspeksi');
    }
}
