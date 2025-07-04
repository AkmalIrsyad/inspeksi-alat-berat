<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Inspeksi;
use App\Models\Komponen;
use App\Models\AlatBerat;
use Illuminate\Support\Facades\Auth;

class CreateInspeksi extends Component
{
    public $alatBeratId;
    public $selectedKomponen = [];
    public $comment;

    public function save()
    {
        $inspeksi = Inspeksi::create([
            'user_id' => Auth::id(),
            'alat_berat_id' => $this->alatBeratId, // ← Tambahkan ini
            'comment' => $this->comment
        ]);

        foreach ($this->selectedKomponen as $komponenId => $data) {
            $inspeksi->komponens()->attach($komponenId, [
                'status' => $data['status'] ?? null,
                'komentar' => $data['komentar'] ?? null,
            ]);
        }

        session()->flash('success', 'Inspeksi berhasil disimpan.');
        $this->reset();
    }

    public function render()
    {
          // Ambil ID alat berat yang sudah diinspeksi oleh user ini
         $alatBeratSudahDiinspeksi = Inspeksi::where('user_id', Auth::id())
        ->pluck('alat_berat_id')
        ->toArray();

        // Ambil alat berat yang belum diinspeksi
        $alatBerats = AlatBerat::whereNotIn('id', $alatBeratSudahDiinspeksi)->get();

        // $alatBerats = AlatBerat::all();


        $komponens = [];
        if ($this->alatBeratId) {
            $komponens = Komponen::where('alat_berats_id', $this->alatBeratId)->get();
        }
        return view('livewire.create-inspeksi', compact('alatBerats', 'komponens'));
    }


}
