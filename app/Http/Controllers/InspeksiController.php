<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspeksiController extends Controller
{
    public function show($id)
{
    $inspeksi = Inspeksi::with(['komponens','alatBerat'])->findOrFail($id);

    // Optional: batasi hanya milik user itu
    if ($inspeksi->user_id !== Auth::id()) {
        abort(403);
    }

    return view('inspektor.inspeksi.detail', compact('inspeksi'));
}
}
