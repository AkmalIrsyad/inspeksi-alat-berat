<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public function exportPdf($id)
{
    $inspeksi = Inspeksi::with(['user', 'alatBerat', 'komponens'])->findOrFail($id);

    $pdf = Pdf::loadView('inspektor.inspeksi.export', compact('inspeksi'));

    return $pdf->download('Inspeksi-' . $inspeksi->id . '.pdf');
}
}
