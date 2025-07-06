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
    public $komponens = [['name' => '']];
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

    public function addField()
    {
    $this->komponens[] = ['name' => ''];
    }

    public function removeField($index)
{
    unset($this->komponens[$index]);
    $this->komponens = array_values($this->komponens); // reset index
}

    public function store()
    {
      $this->validate([
        'komponens.*.name' => 'required',
    ], [
        'komponens.*.name.required' => 'Nama Komponen tidak boleh kosong',
    ]);

    foreach ($this->komponens as $komponen) {
        Komponen::create([
            'alat_berats_id' => $this->alatBerats_id,
            'name' => $komponen['name'],
        ]);
    }

    session()->flash('success', 'Semua Komponen berhasil disimpan.');
    $this->dispatch('lihat-komponen');
    $this->reset(['komponens']);
    $this->komponens = [['name' => '']];
    }

    public function lihat()
    {
        $this->dataKomponen['komponen']= Komponen::paginate(10);
        // $this->lihatPage = true;
    }
}
