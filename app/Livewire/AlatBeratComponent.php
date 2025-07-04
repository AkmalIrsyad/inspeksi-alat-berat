<?php

namespace App\Livewire;

use App\Models\AlatBerat;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AlatBeratComponent extends Component
{
    use WithPagination,WithoutUrlPagination,WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $addPage,$editPage = false;
    public $merk,$serial_number,$jenis,$foto,$id;
    public function render()
    {
        $data['alatBerat'] = AlatBerat::paginate(10);
        return view('livewire.alat-berat-component',$data);
    }
    public function create()
    {
        $this->reset();
        $this->addPage = true;
    }
    public function store()
    {
        $this->validate([
            'merk'=>'required',
            'serial_number'=>'required',
            'jenis'=>'required',
            'foto'=>'required|image',
        ],[
            'merk.required'=>'merk tidak boleh kosong',
            'serial_number.required'=>'serial number tidak boleh kosong',
            'jenis.required'=>'jenis tidak boleh kosong',
            'foto.required'=>'foto tidak boleh kosong',
            'foto.image'=>'foto dalam format image',
        ]);

        $this->foto->storeAs('alatberat', $this->foto->hashName(),'public');
        AlatBerat::create([
            'merk'=>$this->merk,
            'serial_number'=>$this->serial_number,
            'jenis'=>$this->jenis,
            'foto'=>$this->foto->hashName()
        ]);
        session()->flash('success','berhasil Simpan Data');
        $this->reset();
    }

    public function edit($id)
    {
        $this->reset();
        $this->editPage = true;
        $this->id = $id;
        $alatBerat= AlatBerat::find($id);
        $this->merk = $alatBerat->merk;
        $this->serial_number = $alatBerat->serial_number;
        $this->jenis = $alatBerat->jenis;
    }

    public function update()
    {
        $alatBerat = AlatBerat::find($this->id);
        if (empty($this->foto)) {
            $alatBerat->update([
                'merk'=>$this->merk,
                'serial_number'=>$this->serial_number,
                'jenis'=>$this->jenis,
            ]);
        }else{
            unlink(public_path('storage/alatberat/' . $alatBerat->foto));
            $this->foto->storeAs('alatberat', $this->foto->hashName(),'public');
            $alatBerat->update([
                'merk'=>$this->merk,
                'serial_number'=>$this->serial_number,
                'jenis'=> $this->jenis,
                'foto' => $this->foto->hashName()
            ]);
        }
        session()->flash('success','Berhasi Diubah');
        $this->reset();
    }


    public function destroy($id)
    {
        $alatBerat = AlatBerat::find($id);
        unlink(public_path('storage/alatberat/'.$alatBerat->foto));
        $alatBerat->delete();
        session()->flash('success','Berhasil Hapus');
        $this->reset();
    }
}
