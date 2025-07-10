<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspectorController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Inspeksi::with('alatBerat')
        ->where('user_id', $user->id);

    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->start_date && $request->end_date) {
        $start = Carbon::parse($request->start_date)->startOfDay(); // 00:00:00
        $end = Carbon::parse($request->end_date)->endOfDay();       // 23:59:59
        $query->whereBetween('created_at', [$start, $end]);
    }

    if ($request->serial_number) {
        $query->whereHas('alatBerat', function ($q) use ($request) {
            $q->where('serial_number', 'like', '%' . $request->serial_number . '%');
        });
    }

    $filteredInspeksi = $query->latest()->paginate(10);

         return view('inspektor.index', [
        'totalInspeksi' => Inspeksi::where('user_id', $user->id)->count(),
        'pending' => Inspeksi::where('user_id', $user->id)->where('status', 'Pending')->count(),
        'approved' => Inspeksi::where('user_id', $user->id)->where('status', 'Approved')->count(),
        'cancel' => Inspeksi::where('user_id', $user->id)->where('status', 'Cancel')->count(),
        'filteredInspeksi' => $filteredInspeksi,
    ]);
    }
}
