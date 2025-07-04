<?php

namespace App\Livewire;

use App\Models\Inspeksi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InspeksiIndex extends Component
{
    public function render()
    {
        $inspeksis = Inspeksi::where('user_id', Auth::id())->with('komponens')->latest()->get();
        return view('livewire.inspeksi-index', compact('inspeksis'));
    }
}
