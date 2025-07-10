<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SupervisorInspeksiController extends Controller
{
    public function index()
    {

        $inspeksis = Inspeksi::with('alatBerat', 'user')->latest()->get();
        return view('supervisor.inspeksi.index', compact('inspeksis'));
    }

    public function approve($id)
    {
        $inspeksi = Inspeksi::findOrFail($id);
        $inspeksi->status = 'Approved';
        $inspeksi->save();

        return redirect()->back()->with('success', 'Inspeksi disetujui.');
    }

    public function cancel($id)
    {
        $inspeksi = Inspeksi::findOrFail($id);
        $inspeksi->status = 'Cancel';
        $inspeksi->save();

        return redirect()->back()->with('success', 'Inspeksi dibatalkan.');
    }

    public function show($id)
    {
    $inspeksi = Inspeksi::with(['user', 'alatBerat', 'komponens'])->findOrFail($id);
    return view('supervisor.inspeksi.detail', compact('inspeksi'));
    }

    public function exportPdf($id)
{
    $inspeksi = Inspeksi::with(['user', 'alatBerat', 'komponens'])->findOrFail($id);

    $pdf = Pdf::loadView('supervisor.inspeksi.export', compact('inspeksi'));

    return $pdf->download('Inspeksi-' . $inspeksi->id . '.pdf');
}

    public function destroy($id)
{
    $inspeksi = Inspeksi::findOrFail($id);

    // Jika ada relasi lain yang perlu dihapus juga, tambahkan di sini (misalnya: $inspeksi->komponens()->delete();)

    $inspeksi->delete();

    return redirect()->back()->with('success', 'Data inspeksi berhasil dihapus.');
}

}
