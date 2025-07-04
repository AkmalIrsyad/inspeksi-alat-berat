<?php

namespace App\Livewire;

use App\Models\Komponen;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class LihatKomponen extends Component
{
    use WithPagination,WithoutUrlPagination;

    #[On('lihat-komponen')]
    public function render()
    {
        $this->reset();
        $komponen = Komponen::with('alatBerat')->get()->groupBy(function($item) {
            return $item->alatBerat?->serial_number ?? 'Serial Number Tidak Diketahui';
        });

        return view('livewire.lihat-komponen', compact('komponen'));
        // $data['komponen']=Komponen::paginate(10);
        // return view('livewire.lihat-komponen',$data);
    }
    public function destroy($id)
    {
        $kompenen = Komponen::find($id);
        $kompenen->delete();
        session()->flash('success','Berhasil Hapus');
        $this->reset();
    }
}
