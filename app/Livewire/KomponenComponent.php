<?php

namespace App\Livewire;

use App\Models\AlatBerat;
use App\Models\Komponen;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class KomponenComponent extends Component
{
    use WithPagination,WithoutUrlPagination;

    public $addPage,$editPage = false;
    public $name, $alatBerats_id;
    public function render()
    {
        $data['alatBerat'] = AlatBerat::paginate(5);
        return view('livewire.komponen-component',$data);
    }
    public function create($id)
    {
        $this->alatBerats_id = $id;
        $this->addPage = true;
    }

    public function store()
    {
        $this->validate([
            'name'=>'required',
        ],[
            'name.required'=>'Nama Komponen Tidak Boleh Kosong',
        ]);
        Komponen::create([
            'alat_berats_id'=>$this->alatBerats_id,
            'name'=>$this->name,
        ]);

        session()->flash('success','Komponen Berhasil Disimpan');
        $this->dispatch('lihat-komponen');
        $this->reset();
    }

    public function lihat()
    {
        $this->dataKomponen['komponen']= Komponen::paginate(10);
        // $this->lihatPage = true;
    }
}
