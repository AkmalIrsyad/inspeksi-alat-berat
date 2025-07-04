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
        'approved' => Inspeksi::where('status', 'approved')->count(),
        'cancel'   => Inspeksi::where('status', 'cancel')->count(),
        'pending'  => Inspeksi::where('status', 'pending')->count(),
    ];
        //
        $jnsAlatberat = [
        'Excavator' => Inspeksi::where('status', 'Excavator')->count(),
        'Bulldozer'   => Inspeksi::where('status', 'Bulldozer')->count(),
        'Crane'  => Inspeksi::where('status', 'Crane')->count(),
        'Wheel Loader'  => Inspeksi::where('status', 'Wheel Loader')->count(),
        'Forklift'  => Inspeksi::where('status', 'Forklift')->count(),
        'Grader'  => Inspeksi::where('status', 'Grader')->count(),
        'Dump Truck'  => Inspeksi::where('status', 'Dump Truck')->count(),
        'Paver'  => Inspeksi::where('status', 'Paver')->count(),
        'Roller Compactor'  => Inspeksi::where('status', 'Roller Compactor')->count(),
    ];


        return view('supervisor.index',compact('data','jnsAlatberat','statusData'));
    }
}
