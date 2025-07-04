<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function proses(Request $request)
    {
        $credential = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ],[
            'email.required'=>'email tidak boleh kosong!',
            'email.email'=>'Format email salah',
            'password.required'=> 'password tidak boleh kosong'
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect sesuai role
            switch ($user->role) {
                case 'inspector':
                    return redirect()->route('inspektor.index');
                case 'supervisor':
                    return redirect()->route('supervisor.index');
                default:
                    Auth::logout();
                    return back()->withErrors(['email' => 'Role tidak dikenali.'])->onlyInput('email');
            }
        }

        return back()->withErrors([
            'email' => 'Authentikasi Gagal',
        ])->onlyInput('email');
    }

    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
