<?php

namespace App\Http\Controllers;

use App\Models\AlatBerat;
use App\Models\Inspeksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'jmlInspeksi'  => Inspeksi::count(),
            'jmlAlatberat' => AlatBerat::count(),
            'jmlAnggota'   => User::count(),
        ];
         // Ambil data untuk Chart
    $statusData = [
        'Approved' => Inspeksi::where('status', 'Approved')->count(),
        'Cancel'   => Inspeksi::where('status', 'Cancel')->count(),
        'Pending'  => Inspeksi::where('status', 'Pending')->count(),
    ];

    $query = Inspeksi::query()->with('alatBerat');

    if ($request->start_date && $request->end_date) {
        $start = Carbon::parse($request->start_date)->startOfDay(); // 00:00:00
        $end   = Carbon::parse($request->end_date)->endOfDay();       // 23:59:59
        $query->whereBetween('created_at', [$start, $end]);
    }

    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->serial) {
        $query->whereHas('alatBerat', function ($q) use ($request) {
            $q->where('serial_number', 'like', '%' . $request->serial . '%');
        });
    }

    $filteredInspeksi = $query->latest()->paginate(10);




        return view('supervisor.index',compact('data','statusData','filteredInspeksi'));
    }
}
