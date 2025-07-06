<?php

namespace App\Http\Controllers;

use App\Models\AlatBerat;
use App\Models\Inspeksi;
use App\Models\User;
use App\Notifications\NotifikasiInspeksi;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
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
        //



        return view('supervisor.index',compact('data','statusData'));
    }
}
